<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class SessionController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function postregister(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users|min:6',
            'password' => 'required|min:8',
        ]);

        $data = [
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ];

        

        User::create($data);
        return redirect()->route('login');
    }

    public function login()
    {
        return view('login');
    }

    public function postlogin(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($data)) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }

}
