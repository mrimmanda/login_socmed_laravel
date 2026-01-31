<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view ('register.index');
    }

    public function storeRegister(Request $request)
    {
        // 1. VALIDASI
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // 2. INSERT USER
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'provider' => 'Manual',
        ]);

        // 3. AUTO LOGIN
        Auth::login($user);

        return redirect('/home')->with('success', 'Register berhasil');
    }
}
