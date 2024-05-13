<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $user = User::where('email', $request->name)->first();

        if ($user && $user->password === $request->password) {
            // Autenticación exitosa, inicia sesión            
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        } else {
            return redirect(route('login'))->with('error', 'El nombre de usuario o la contraseña no son correctos.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }
}
