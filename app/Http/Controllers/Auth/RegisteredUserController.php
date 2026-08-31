<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $data['meta_title'] = 'Inscription';
        return view('auth.register', $data);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:admin,chef_chantier,chef_equipe,directeurs',

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role, //added role attribute
        ]);

        event(new Registered($user));

        

        Auth::login($user);

        // Redirection selon le rôle
        if ($user->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        } elseif ($user->role === 'chef_chantier') {
            return redirect()->intended('/chef-chantier/dashboard');
        } elseif ($user->role === 'chef_equipe') {
            return redirect()->intended('/chef-equipe/dashboard');
        } elseif ($user->role === 'directeurs') {
            return redirect()->intended('/directeur/dashboard');
        }

        return redirect()->route('login')->with('error', 'Utilisateur non trouvé.');

    }
}
