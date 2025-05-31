<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    /**
     * Mostrar la vista de confirmación de pedido.
     * Solo usuarios autenticados pueden llegar aquí (gracias al middleware en rutas).
     */
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        $productsInCart = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if (! $product) {
                continue;
            }
            $subtotal = $product->price * $quantity;
            $total += $subtotal;

            $productsInCart[] = [
                'product'  => $product,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];
        }

        return view('checkout.index', compact('productsInCart', 'total'));
    }

    /**
     * Procesar la compra: crear Order y OrderItems, vaciar carrito y redirigir a thankyou.
     */
    public function store(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                             ->with('success', 'Tu carrito está vacío.');
        }

        // Recalcular total por seguridad
        $total = 0;
        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if (! $product) {
                continue;
            }
            $total += $product->price * $quantity;
        }

        DB::beginTransaction();
        try {
            // Crear el pedido principal
            $order = Order::create([
                'user_id' => Auth::id(), // obligatorio porque user_id no es nullable
                'total'   => $total,
            ]);

            // Crear cada item del pedido
            foreach ($cart as $productId => $quantity) {
                $product = Product::find($productId);
                if (! $product) {
                    continue;
                }
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'quantity'   => $quantity,
                    'price'      => $product->price,
                ]);
            }

            // Vaciar el carrito de la sesión
            $request->session()->forget('cart');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Hubo un error procesando tu pedido. Inténtalo de nuevo.');
        }

        // Redirigir a página de agradecimiento
        return redirect()->route('checkout.thankyou')
                         ->with('success', '¡Gracias por tu compra!');
    }

    /**
     * Mostrar página de "Gracias por tu compra".
     */
    public function thankyou()
    {
        return view('checkout.thankyou');
    }
}
