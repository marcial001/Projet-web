<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\View\View;
use App\Models\Absence;
use App\Models\Task;
use App\Models\Leave;

class ProfileController extends Controller
{
    /**
     * Afficher le formulaire de profil utilisateur.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        // Si l'utilisateur est admin, il peut voir tous les détails
        if ($user->role === 'admin') {
            return view('profile.edit', [
                'user' => $user,
                'roles' => ['admin', 'chef_chantier', 'chef_equipe', 'directeurs']
            ]);
        }

        // Chef de chantier ou chef d'équipe peuvent modifier leur propre profil
        if (in_array($user->role, ['chef_chantier', 'chef_equipe'])) {
            return view('profile.edit', [
                'user' => $user,
                'roles' => [$user->role] // Ils ne peuvent pas changer de rôle
            ]);
        }

        // Directeur ou employé : accès limité
        return view('profile.edit', [
            'user' => $user,
            'roles' => [] // Aucune modification de rôle possible
        ]);
    }

    /**
     * Mettre à jour les informations du profil.
     */
    public function update(Request $request)
    {
        $user = $request->user();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'role' => ['sometimes', 'in:admin,chef_chantier,chef_equipe,directeurs'],
        ]);

        // Seul l'admin peut modifier le rôle
        if ($request->has('role') && $user->role !== 'admin') {
            abort(403, "Vous n'êtes pas autorisé à modifier le rôle.");
        }

        // Mise à jour du mot de passe si fourni
        if (!empty($validated['password'] ?? null)) {
            $user->password = Hash::make($validated['password']);
        }

        // Mise à jour des autres champs
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];

        if ($user->isDirty('email')) {
            $user->email_verified_at = null; // Réinitialiser la vérification
        }

        if ($request->has('role')) {
            $user->role = $validated['role'];
        }

        $user->save();

        // Redirection selon le rôle
        if ($user->role === 'admin') {
            return Redirect::route('admin.dashboard')->with('status', 'Profil mis à jour avec succès.');
        } elseif ($user->role === 'chef_chantier') {
            return Redirect::route('chef-chantier.dashboard')->with('status', 'Profil mis à jour avec succès.');
        } elseif ($user->role === 'chef_equipe') {
            return Redirect::route('chef-equipe.dashboard')->with('status', 'Profil mis à jour avec succès.');
        } elseif ($user->role === 'directeurs') {
            return Redirect::route('directeur.dashboard')->with('status', 'Profil mis à jour avec succès.');
        } else {
            return Redirect::route('home')->with('status', 'Profil mis à jour avec succès.');
        }
    }

    /**
     * Supprimer un compte utilisateur.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        $role = $user->role;

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirection selon le rôle
        if ($role === 'admin') {
            return Redirect::route('admin.dashboard');
        } elseif ($role === 'chef_chantier') {
            return Redirect::route('chef-chantier.dashboard');
        } elseif ($role === 'chef_equipe') {
            return Redirect::route('chef-equipe.dashboard');
        } elseif ($role === 'directeurs') {
            return Redirect::route('directeur.dashboard');
        } else {
            return Redirect::route('home');
        }
    }

    /**
     * Consultation de la liste des absences (admin uniquement).
     */
    public function consulterAbsences(Request $request)
    {
        $user = $request->user();

        // Seul l'admin peut accéder à cette route
        if ($user->role !== 'admin') {
            abort(403, "Accès réservé à l'administrateur.");
        }

        $absences = Absence::with('employee')->latest()->get();

        return view('admin.absences.index', compact('absences'));
    }

    /**
     * Consultation de la liste des tâches (admin uniquement).
     */
    public function consulterTasks(Request $request)
    {
        $user = $request->user();

        // Seul l'admin peut accéder à cette route
        if ($user->role !== 'admin') {
            abort(403, "Accès réservé à l'administrateur.");
        }

        $tasks = Task::with('employee')->latest()->get();

        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Consultation de la liste des congés (admin uniquement).
     */
    public function consulterLeaves(Request $request)
    {
        $user = $request->user();

        // Seul l'admin peut accéder à cette route
        if ($user->role !== 'admin') {
            abort(403, "Accès réservé à l'administrateur.");
        }

        $leaves = Leave::with('employee')->latest()->get();

        return view('admin.leaves.index', compact('leaves'));
    }
}