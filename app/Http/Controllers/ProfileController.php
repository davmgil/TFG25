<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name'  => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email,'.Auth::id()],
        ]);

        $user = User::findOrFail(Auth::id());
        $user->fill([
            'name'  => $data['name'],
            'email' => $data['email'],
        ])->save();

        return back()->with('status','Perfil actualizado correctamente.');
    }
}
