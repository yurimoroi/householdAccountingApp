<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Controller
{
    public function getLogin()
    {

        return view('auth.login');
    }

    public function getSignup()
    {
        return view('auth.signup');
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
            'user_id' => 'ユーザーIDまたはパスワードが一致しません。',
            'password' => 'ユーザーIDまたはパスワードが一致しません。'
        ]);
    }

    public function signup(Request $request)
    {

        User::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function getDashboard()
    {
        $userId = Auth::user()->user_id;

        $items = Item::select('items.id', 'items.type', 'items.create_dt', 'categories.name', 'items.amount', 'items.content')->join('categories', 'items.category', '=', 'categories.id')->where('items.user_id', $userId)->orderBy("items.id", "asc")->get();

        return view("dashboard", compact('items'));
    }

    public function getReport()
    {
        $userId = Auth::user()->user_id;

        $items = Item::select('items.id', 'items.type', 'items.create_dt', 'categories.name', 'items.amount', 'items.content')->join('categories', 'items.category', '=', 'categories.id')->where('items.user_id', $userId)->orderBy("items.id", "asc")->get();

        return view("report", compact('items'));
    }
}
