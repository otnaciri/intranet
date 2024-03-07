<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // Tenter de connecter l'utilisateur
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Si l'authentification réussit, retourner un message de succès et les détails de l'utilisateur connecté
            return response()->json(['success' => true, 'user' => Auth::user()], 200);
        } else {
            // Si l'authentification échoue, retourner un message d'erreur
            return response()->json(['success' => false, 'message' => 'Identifiants invalides'], 401);
        }
    }
}
