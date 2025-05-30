<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Mostrar formulario de login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Autenticar usuario.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('products.index'));
        }

        return back()
            ->withErrors(['email' => 'Las credenciales no coinciden.'])
            ->withInput($request->only('email'));
    }

    /**
     * Cerrar sesión.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('products.index');
    }
}
