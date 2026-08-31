<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $data['meta_title'] = 'Connexion';
        return view('auth.login', $data);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        /*if (Auth::user()->role === 'admin') {
            return redirect('admin/dashboard');
        }*/

        // Redirect based on user role
        $user = Auth::user();

        //if (!$user) {
            //return redirect()->route('login')->with('error', 'Utilisateur non trouvé.');
       // }

        if ($user->role === 'admin') 
        {
            
            return redirect()->intended('/admin/dashboard');
        } 
        elseif ($user->role === 'chef_chantier') {
            return redirect()->intended('/chef-chantier/dashboard');
        } 
        elseif ($user->role === 'chef_equipe') {
            return redirect()->intended('/chef-equipe/dashboard');
        } 
        elseif ($user->role === 'directeurs') {
            return redirect()->intended('/directeur/dashboard');
        }

            return redirect()->route('login')->with('error', 'Utilisateur non trouvé.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
