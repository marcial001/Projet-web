{{-- filepath: resources/views/profile/edit.blade.php --}}
@extends('layouts.app')
@section('title', 'Mon Profil')

@section('content')
    <div class="register-card h-100 mx-auto" style="max-width:600px; width:100%;">

        <h3 class="text-center mb-5">Mon Profil</h3>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <!-- Nom -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-person"></i></span>
                <input type="text" name="name" class="form-control" placeholder="Nom" required value="{{ old('name', $user->name) }}">
            </div>

            <!-- Email -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ old('email', $user->email) }}">
            </div>

            <!-- Numéro de téléphone -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-telephone"></i></span>
                <input id="phone" type="text" class="form-control" name="phone" placeholder="Numéro de téléphone"
                    autocomplete="tel" value="{{ old('phone', $user->phone) }}">
            </div>

            <!-- Mot de passe (optionnel) -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Nouveau mot de passe (laisser vide pour ne pas changer)">
            </div>

            <!-- Confirmer le mot de passe (optionnel) -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-lock-fill"></i></span>
                <input type="password" name="password_confirmation" class="form-control"
                    placeholder="Confirmer le mot de passe">
            </div>

            <!-- Bouton enregistrer -->
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-success">
                    Mettre à jour mon profil
                </button>
            </div>
        </form>

        <!-- Suppression du compte -->
        <div class="mt-4">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
@endsection