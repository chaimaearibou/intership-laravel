<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function showLoginForm()  // la fonctio qui retourne la page de login  (login deja ando compte)
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $ip = $request->ip();

    if (RateLimiter::tooManyAttempts('login-attempt:' . $ip, 5)) {
        $error = ['email' => ['Too many login attempts. Please try again in a few minutes.']];

        return $request->ajax()
            ? response()->json(['errors' => $error], 422)
            : back()->withErrors($error)->withInput();
    }

    RateLimiter::hit('login-attempt:' . $ip, 60);

    $user = Utilisateur::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        $error = ['email' => ['Email or password is incorrect']];

        return $request->ajax()
            ? response()->json(['errors' => $error], 422)
            : back()->withErrors($error)->withInput();
    }

    Auth::login($user);
    $request->session()->regenerate();
    RateLimiter::clear('login-attempt:' . $ip);

    $redirectRoute = $user->role === 'admin'
        ? route('dasbordAdmin')
        : route('home'); // or user dashboard if available

    return $request->ajax()
        ? response()->json(['redirect' => $redirectRoute])
        : redirect($redirectRoute);
}



    public function showRegisterForm()   // la fonction  qui retourne la page de registre (registre radi creer nouveau compte)
    {
        return view('auth.registre');
    }

    public function register(Request $request)     // la fonction qui creer un nouveau compte
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = Utilisateur::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'interne', // default role
        ]);

        Auth::login($user);

        return redirect()->route('dashboard.user');
    }

    public function logout(Request $request)    // la fonction qui deconnecter l'utilisateur
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
