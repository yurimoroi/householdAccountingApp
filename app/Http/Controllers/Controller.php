<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Controller
{
    public function getLogin()
    {

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('user_id', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            $request->session()->put('user_id', Auth::user()->user_id);
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'user_id' => 'ユーザー情報が一致しません。'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
