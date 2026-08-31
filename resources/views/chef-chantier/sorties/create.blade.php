@extends('layouts.app')
@section('title', 'Nouvelle Sortie de Matériel')

@section('content')
    <div class="register-card h-100">

        <h3 class="text-center mb-5">Demande de Sortie de Matériel</h3>

        <form method="POST" action="{{ route('chef-chantier.materiels.sorties.store') }}">
            @csrf

            <!-- Type de Matériel -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-box"></i></span>
               <input type="text" name="type_materiel" id="type_materiel" class="form-control" required placeholder="Type de matériel" value="{{ old('type_materiel') }}">
            </div>

            <!-- Employé concerné (facultatif) -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-person"></i></span>
                <input type="text" name="employee_id" id="employee_id" class="form-control" placeholder="Employé concerné (facultatif)" value="{{ old('employee_id') }}">
            </div>

            <!-- Quantité à sortir -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-123"></i></span>
                <input type="number" name="quantite" id="quantite" class="form-control" min="1" required placeholder="Quantité à sortir" value="{{ old('quantite') }}">
            </div>

            <!-- Raison de la sortie -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-chat-left-text"></i></span>
                <input type="text" name="raison" id="raison" class="form-control" required placeholder="Raison de la sortie" value="{{ old('raison') }}">
            </div>

            <!-- Destination -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-geo-alt"></i></span>
                <input type="text" name="destination" id="destination" class="form-control" required placeholder="Destination" value="{{ old('destination') }}">
            </div>

            <!-- Bouton enregistrer -->
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-success">
                    Valider la sortie
                </button>
            </div>

            <!-- Retour à la liste -->
            <div class="mt-3 text-center">
                <p class="text-muted">
                    <a href="{{ route('chef-chantier.materiels.sorties.index') }}" class="text-success text-decoration-none" style="font-weight:500">
                        Retour à la liste des sorties
                    </a>
                </p>
            </div>
        </form>
    </div>
@endsection