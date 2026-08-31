@extends('layouts.app')
@section('title', 'Inscription')

@section('content')

<!-- Affichage des erreurs -->
<span style="color: yellow;">{{ $errors->first('email') }}<br></span>
<span style="color: red;">{{ $errors->first('password') }}<br></span>
<span style="color: red;">{{ $errors->first('password_confirmation') }}<br></span>

<div class="register-card">

    @include('_message')

    <h3 class="text-center mb-4">Inscription</h3>

    <form method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <!-- Nom -->
        <div class="mb-4 input-group">
            <span class="input-group-text icon-bg-green"><i class="bi bi-person"></i></span>
            <input id="name" type="text" class="form-control" placeholder="Nom" name="name" required autofocus
                autocomplete="name" value="{{ old('name') }}">
        </div>

        <!-- Email -->
        <div class="mb-4 input-group">
            <span class="input-group-text icon-bg-green"><i class="bi bi-envelope"></i></span>
            <input id="email" type="email" class="form-control" name="email" placeholder="Email" autocomplete="username"
                value="{{ old('email') }}" required>
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
            <input id="password" type="password" class="form-control" name="password" placeholder="Mot de passe"
                required autocomplete="new-password">
        </div>

        <!-- Confirmation du mot de passe -->
        <div class="mb-4 input-group">
            <span class="input-group-text icon-bg-green"><i class="bi bi-lock-fill"></i></span>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                placeholder="Confirmer le mot de passe" required autocomplete="new-password">
        </div>

        <!-- Bouton s'inscrire -->
        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-success">
                S'inscrire
            </button>
        </div>

        <!-- Déjà inscrit -->
        <div class="mt-3 text-center">
            <p class="text-muted">
                Déjà inscrit ?
                <a href="{{ route('login') }}" class="text-success text-decoration-none" style="font-weight:500">Se
                    connecter</a>
            </p>
        </div>
    </form>
</div>