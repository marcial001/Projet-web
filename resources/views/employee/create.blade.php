@extends('layouts.app')
@section('title', 'Ajouter un Employé')

@section('content')
    <div class="register-card h-100">

        <h3 class="text-center mb-5">Ajouter un Employé</h3>

        <form method="POST" action="{{ route('employees.store') }}">
            @csrf

            <!-- Nom -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-person"></i></span>
                <input type="text" name="name" class="form-control" placeholder="Nom" required value="{{ old('name') }}">
            </div>

            <!-- Prénom -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-person"></i></span>
                <input type="text" name="prenom" class="form-control" placeholder="Prénom" required value="{{ old('prenom') }}">
            </div>

         <!-- Numéro de téléphone -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-telephone"></i></span>
                <input type="tel" name="phone" class="form-control" placeholder="Numéro de téléphone" required value="{{ old('phone') }}">
            </div>

            <!-- fonction-->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-briefcase"></i></span>
                <input type="text" name="fonction" class="form-control" placeholder="Fonction" required value="{{ old('fonction') }}">
            </div>

            <!-- Chef de Chantier (optionnel) -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-person-badge"></i></span>
                <select name="chef_chantier_id" class="form-select">
                    <option value="">Chef de Chantier (optionnel)</option>
                    @foreach ($chefs as $chef)
                        <option value="{{ $chef->id }}" {{ old('chef_chantier_id') == $chef->id ? 'selected' : '' }}>
                            {{ $chef->name }}
                        </option>
                    @endforeach
                </select>
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
                    <a href="{{ route('employees.index') }}" class="text-success text-decoration-none" style="font-weight:500">
                        Retour à la liste des employés
                    </a>
                </p>
            </div>
        </form>
    </div>
@endsection