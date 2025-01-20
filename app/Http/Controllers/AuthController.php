<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\RegisteredCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email', // Validasi email untuk admin
            'password' => 'required|string', // Validasi password
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Periksa apakah user adalah admin
            if ($user->is_admin) {
                Auth::login($user);  // Login sebagai admin
                return redirect()->route('admin.dashboard'); // Arahkan ke dashboard admin
            } else {
                return back()->withErrors([
                    'credentials' => 'You do not have admin privileges.',
                ]);
            }
        }

        return back()->withErrors([
            'credentials' => 'The provided credentials are incorrect.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
