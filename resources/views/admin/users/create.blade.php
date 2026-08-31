@extends('layouts.app')
@section('title', 'Créer un Utilisateur')

@section('content')
    <div class="register-card h-100">

        <h3 class="text-center mb-5">Ajouter un Utilisateur</h3>

        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <!-- Nom -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-person"></i></span>
                <input type="text" name="name" class="form-control" placeholder="Nom" required value="{{ old('name') }}">
            </div>

            <!-- Email -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Email" required
                    value="{{ old('email') }}">
            </div>

            <!-- Numéro de téléphone -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-telephone"></i></span>
                <input id="phone" type="text" class="form-control" name="phone" placeholder="Numéro de téléphone"
                    autocomplete="tel" value="{{ old('phone') }}">
            </div>

            <!-- Sélection du rôle -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-person-badge"></i></span>
                <select name="role" id="role" class="form-select" required>
                    <option value="" disabled {{ old('role') ? '' : 'selected' }}>Sélectionnez un rôle</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                    <option value="chef_chantier" {{ old('role') == 'chef_chantier' ? 'selected' : '' }}>Chef de Chantier
                    </option>
                    <option value="chef_equipe" {{ old('role') == 'chef_equipe' ? 'selected' : '' }}>Chef d'Équipe</option>
                    <option value="directeurs" {{ old('role') == 'directeurs' ? 'selected' : '' }}>Directeurs</option>
                </select>
            </div>

            <!-- Mot de passe -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
            </div>

            <!-- Confirmer le mot de passe -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-lock-fill"></i></span>
                <input type="password" name="password_confirmation" class="form-control"
                    placeholder="Confirmer le mot de passe" required>
            </div>



            <!-- Bouton enregistrer -->
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-success">
                    Enregistrer
                </button>
            </div>

            <!-- Retour à la liste -->
            <div class="mt-3 text-center">
                <p class="text-muted">
                    <a href="{{ route('users.index') }}" class="text-success text-decoration-none"
                        style="font-weight:500">
                        Retour à la liste des utilisateurs
                    </a>
                </p>
            </div>
        </form>
    </div>
@endsection