@extends('layouts.app')
@section('title', 'Ajouter un Matériel')

@section('content')
    <div class="register-card h-100">

        <h3 class="text-center mb-5">Ajouter un Stock</h3>

        <form method="POST" action="{{ route('admin.materiels.store') }}">
            @csrf

            <!-- Nom du stock -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-box"></i></span>
                <input type="text" name="nom" class="form-control" placeholder="Nom du matériel" required value="{{ old('nom') }}">
            </div>

            <!-- Type de matériel -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-tag"></i></span>
                <input type="text" name="type" class="form-control" placeholder="Type de matériel" required value="{{ old('type') }}">
            </div>

            <!-- Quantité disponible -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-123"></i></span>
                <input type="number" name="quantite_disponible" class="form-control" placeholder="Quantité disponible" min="0" required value="{{ old('quantite_disponible') }}">
            </div>

            <!-- Localisation (optionnel) -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-geo-alt"></i></span>
                <input type="text" name="localisation" class="form-control" placeholder="Localisation (optionnel)" value="{{ old('localisation') }}">
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
                    <a href="{{ route('admin.materiels.index') }}" class="text-success text-decoration-none" style="font-weight:500">
                        Retour à la liste des matériels
                    </a>
                </p>
            </div>
        </form>
    </div>
@endsection