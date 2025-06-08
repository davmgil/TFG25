<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $total = 0;
        $productsInCart = [];

        foreach ($cart as $id => $qty) {
            if (! $product = Product::find($id)) {
                continue;
            }

            $unit_price = $product->effective_price;   // precio con descuento
            $subtotal   = $unit_price * $qty;
            $total     += $subtotal;

            $productsInCart[] = [
                'product'    => $product,
                'quantity'   => $qty,
                'unit_price' => $unit_price,
                'subtotal'   => $subtotal,
            ];
        }

        return view('cart.index', compact('productsInCart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = $request->session()->get('cart', []);
        $cart[$product->id] = ($cart[$product->id] ?? 0) + 1;
        $request->session()->put('cart', $cart);

        return back()->with('success', 'Producto añadido al carrito.');
    }

    public function remove(Request $request, Product $product)
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$product->id]);
        $request->session()->put('cart', $cart);

        return back()->with('success', 'Producto eliminado del carrito.');
    }
}
