<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()  // la fonctio qui retourne la page de login  (login deja ando compte)
    {
        return view('auth.login');
    }

    public function login(Request $request)    // la fonction qui verifie si l'utilisateur existe deja ou pas
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('dasbordAdmin');
            } else {
                return redirect()->route('home');   //!  i will change here later when i create user dashbord
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
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
            'mot_de_passe' => 'required|confirmed|min:6',
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
