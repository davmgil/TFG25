<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Product;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Mostrar la sección “Mi Cuenta”
     * - Pedidos del usuario
     * - Direcciones
     * - Métodos de pago
     */
    public function index()
    {
        $user = Auth::user();

        // Pedidos del usuario (con sus items y productos)
        $orders = Order::where('user_id', $user->id)
                       ->with('orderItems.product')
                       ->orderBy('created_at', 'desc')
                       ->paginate(10);

        // Direcciones del usuario
        $addresses = Address::where('user_id', $user->id)
                            ->orderBy('is_default', 'desc')
                            ->get();

        // Métodos de pago del usuario
        $payments = Payment::where('user_id', $user->id)
                           ->orderBy('is_default', 'desc')
                           ->get();

        return view('profile.index', compact('user', 'orders', 'addresses', 'payments'));
    }

    //Actualiza nombre y correo
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);
        dd(get_class($user));
        $user->update($data);

        return redirect()
            ->route('profile.index')
            ->with('success', 'Datos personales actualizados.');
    }

    //Almacena nueva dirección
    public function storeAddress(Request $request)
    {
        $data = $request->validate([
            'label'      => ['nullable', 'string', 'max:100'],
            'street'     => ['required', 'string', 'max:255'],
            'city'       => ['required', 'string', 'max:100'],
            'state'      => ['nullable', 'string', 'max:100'],
            'zip_code'   => ['nullable', 'string', 'max:20'],
            'country'    => ['required', 'string', 'max:100'],
            'is_default' => ['required', 'boolean'],
        ]);

        $data['is_default'] = $request->boolean('is_default');
        $data['user_id']    = Auth::id();

        if ($data['is_default']) {
            Address::where('user_id', Auth::id())->update(['is_default' => false]);
        }

        Address::create($data);

        return redirect()
            ->route('profile.index')
            ->with('success', 'Dirección añadida correctamente.');
    }

    //Actualiza dirección
    public function updateAddress(Request $request, Address $address)
    {
        $this->authorize('update', $address);

        $data = $request->validate([
            'label'      => ['nullable', 'string', 'max:100'],
            'street'     => ['required', 'string', 'max:255'],
            'city'       => ['required', 'string', 'max:100'],
            'state'      => ['nullable', 'string', 'max:100'],
            'zip_code'   => ['nullable', 'string', 'max:20'],
            'country'    => ['required', 'string', 'max:100'],
            'is_default' => ['required', 'boolean'],
        ]);

        $data['is_default'] = $request->boolean('is_default');

        if ($data['is_default']) {
            Address::where('user_id', Auth::id())->update(['is_default' => false]);
        }

        $address->update($data);

        return redirect()
            ->route('profile.index')
            ->with('success', 'Dirección actualizada correctamente.');
    }

    //Elimina dirección
    public function destroyAddress(Address $address)
    {
        $this->authorize('delete', $address);
        $address->delete();

        return redirect()
            ->route('profile.index')
            ->with('success', 'Dirección eliminada.');
    }


    //Almacena nuevo método de pago
    public function storePayment(Request $request)
    {
        $data = $request->validate([
            'cardholder_name' => ['required', 'string', 'max:100'],
            'card_number'     => ['required', 'digits:16'],
            'expiry_month'    => ['required', 'integer', 'between:1,12'],
            'expiry_year'     => ['required', 'integer', 'min:' . date('Y')],
            'is_default'      => ['required', 'boolean'],
        ]);

        $data['card_number_last4'] = substr($data['card_number'], -4);
        unset($data['card_number']);

        $data['user_id']    = Auth::id();
        $data['is_default'] = $request->boolean('is_default');

        if ($data['is_default']) {
            Payment::where('user_id', Auth::id())->update(['is_default' => false]);
        }

        Payment::create($data);

        return redirect()
            ->route('profile.index')
            ->with('success', 'Método de pago añadido.');
    }

    //Actualiza método de pago
    public function updatePayment(Request $request, Payment $payment)
    {
        $this->authorize('update', $payment);

        $data = $request->validate([
            'cardholder_name' => ['required', 'string', 'max:100'],
            'expiry_month'    => ['required', 'integer', 'between:1,12'],
            'expiry_year'     => ['required', 'integer', 'min:' . date('Y')],
            'is_default'      => ['required', 'boolean'],
        ]);

        $data['is_default'] = $request->boolean('is_default');

        if ($data['is_default']) {
            Payment::where('user_id', Auth::id())->update(['is_default' => false]);
        }

        $payment->update($data);

        return redirect()
            ->route('profile.index')
            ->with('success', 'Método de pago actualizado.');
    }

    //Elimina método de pago
    public function destroyPayment(Payment $payment)
    {
        $this->authorize('delete', $payment);
        $payment->delete();

        return redirect()
            ->route('profile.index')
            ->with('success', 'Método de pago eliminado.');
    }
}
