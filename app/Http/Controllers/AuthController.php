<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credential = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect('/admin');
            } else if ($user->role === 'owner') {
                if (!$user->outlet_id) return back()->with('error', 'anda belum memiliki outlet'); /// jika owner belum memiliki outlet

                return redirect('/owner');
            } else if ($user->role === 'kasir') {
                return redirect('/cashier');
            }
        }

        return back()->with('error', 'username atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
