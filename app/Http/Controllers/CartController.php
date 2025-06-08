<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index(Request $request)
    {
        // Recupera el carrito y calcula subtotales usando effective_price
        $cart = $request->session()->get('cart', []);
        $total = 0;
        $productsInCart = [];

        foreach ($cart as $id => $qty) {
            if (! $product = Product::find($id)) continue;
            $unitPrice = $product->effective_price;         // precio con descuento
            $subtotal  = $unitPrice * $qty;
            $total    += $subtotal;

            $productsInCart[] = compact('product','qty','unitPrice','subtotal');
        }

        return view('cart.index', compact('productsInCart','total'));
    }

    public function add(Request $request, Product $product)
    {
        // Incrementa cantidad o inicia en 1, actualiza sesión
        $cart = $request->session()->get('cart', []);
        $cart[$product->id] = ($cart[$product->id] ?? 0) + 1;
        $request->session()->put('cart', $cart);

        return back()->with('success','Producto añadido al carrito.');
    }

    public function remove(Request $request, Product $product)
    {
        // Elimina producto del carrito
        $cart = $request->session()->get('cart', []);
        unset($cart[$product->id]);
        $request->session()->put('cart', $cart);

        return back()->with('success','Producto eliminado del carrito.');
    }
}
