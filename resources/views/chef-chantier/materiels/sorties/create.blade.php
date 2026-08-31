@extends('layouts.app')
@section('title', 'Nouvelle Sortie de Matériel')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="p-4" style="background: #d2ede0; border-radius: 16px; box-shadow: 0 2px 12px #0001; max-width: 430px; width: 100%;">
        <h3 class="text-center mb-4" style="background: #218c5a; color: #fff; border-radius: 12px; padding: 18px 0; font-weight: bold;">
            Demande de Sortie de Matériel
        </h3>
        <form method="POST" action="{{ route('chef-chantier.materiels.sorties.store') }}">
            @csrf

            <div class="mb-3 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-box"></i></span>
                <select name="material_id" id="material_id" class="form-select" required>
                    <option value="" disabled selected>Sélectionnez un matériel</option>
                    @foreach ($materials as $mat)
                        <option value="{{ $mat->id }}" {{ old('material_id') == $mat->id ? 'selected' : '' }}>
                            {{ $mat->nom }} ({{ $mat->type }}) - Disponible : {{ $mat->quantite_disponible }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-person"></i></span>
                <select name="employe_id" id="employe_id" class="form-select">
                    <option value="">Aucun</option>
                    @foreach ($employees as $emp)
                        <option value="{{ $emp->id }}">{{ $emp->nom }} {{ $emp->prenom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-123"></i></span>
                <input type="number" name="quantite" id="quantite" class="form-control" min="1" required placeholder="Quantité à sortir" value="{{ old('quantite') }}">
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-chat-left-text"></i></span>
                <input type="text" name="raison" id="raison" class="form-control" required placeholder="Raison de la sortie" value="{{ old('raison') }}">
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-geo-alt"></i></span>
                <input type="text" name="destination" id="destination" class="form-control" required placeholder="Destination" value="{{ old('destination') }}">
            </div>

            <button type="submit" class="btn w-100 fw-bold mt-3" style="background: #218c5a; border: none; color: #fff;">
                Valider la sortie
            </button>

            <div class="mt-3 text-center">
                <a href="{{ route('chef-chantier.materiels.sorties.index') }}" class="text-success text-decoration-none fw-bold">
                    Retour à la liste des sorties
                </a>
            </div>
        </form>
    </div>
</div>
@endsection