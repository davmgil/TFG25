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
    public function index(Request $request)
    {
        // Muestra resumen de carrito autenticado
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

    public function store(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                             ->with('success', 'Tu carrito está vacío.');
        }

        // 1) Recalcular total por seguridad
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
            // 2) Crear el pedido principal
            $order = Order::create([
                'user_id' => Auth::id(), // obligatorio porque user_id no es nullable
                'total'   => $total,
            ]);

            // 3) Crear cada item del pedido y actualizar times_sold en Product
            foreach ($cart as $productId => $quantity) {
                $product = Product::find($productId);
                if (! $product) {
                    continue;
                }

                // Crear el OrderItem
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'quantity'   => $quantity,
                    'price'      => $product->price,
                ]);

                // ** Incrementar el contador de veces vendidas **
                $product->times_sold += $quantity;
                $product->save();
            }

            // 4) Vaciar el carrito de la sesión
            $request->session()->forget('cart');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Hubo un error procesando tu pedido. Inténtalo de nuevo.');
        }

        // 5) Redirigir a página de agradecimiento
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
