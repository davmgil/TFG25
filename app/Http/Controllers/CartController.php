<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Mostrar el contenido del carrito.
     */
    public function index(Request $request)
    {
        // Tomamos el carrito de sesión (o array vacío si no existe)
        $cart = $request->session()->get('cart', []);

        // $cart tendrá la forma: [ product_id => cantidad, ... ]
        // Vamos a recopilar los objetos Product para mostrarlos
        $productsInCart = [];
        $total          = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if (!$product) continue;

            $subtotal = $product->price * $quantity;
            $total += $subtotal;

            $productsInCart[] = [
                'product'  => $product,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];
        }

        return view('cart.index', compact('productsInCart','total'));
    }

    /**
     * Añadir un producto al carrito (1 unidad).
     */
    public function add(Request $request, Product $product)
    {
        // Tomamos el carrito actual de sesión
        $cart = $request->session()->get('cart', []);

        // Si el producto ya estaba, sumamos 1; sino lo añadimos con 1
        if (isset($cart[$product->id])) {
            $cart[$product->id]++;
        } else {
            $cart[$product->id] = 1;
        }

        // Guardamos de nuevo en sesión
        $request->session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Producto añadido al carrito.');
    }

    /**
     * Quitar un producto del carrito por completo.
     */
    public function remove(Request $request, Product $product)
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            $request->session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }
}
