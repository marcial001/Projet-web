@extends('layouts.app')
@section('title', 'Nouvelle Sortie de Matériel')

@section('content')
    <div class="container mt-5">
        <h3>Demande de Sortie de Matériel</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('chef-chantier.materiels.sorties.store') }}">
            @csrf

            <div class="mb-3">
                <label for="material_id">Type de Matériel</label>
                <select name="material_id" id="material_id" class="form-control" required>
                    @foreach ($materials as $mat)
                        <option value="{{ $mat->id }}" {{ old('material_id') == $mat->id ? 'selected' : '' }}>
                            {{ $mat->nom }} ({{ $mat->type }}) - Disponible : {{ $mat->quantite_disponible }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="employe_id" class="form-label">Employé destinataire</label>
                <select name="employe_id" id="employe_id" class="form-control" required>
                    <option value="">Sélectionner un employé</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }} {{ $employee->prenom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="quantite">Quantité à sortir</label>
                <input type="number" name="quantite" id="quantite" class="form-control" min="1" required>
            </div>

            <div class="mb-3">
                <label for="raison">Raison de la sortie</label>
                <input type="text" name="raison" id="raison" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="destination">Destination</label>
                <input type="text" name="destination" id="destination" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Valider la sortie</button>
        </form>
    </div>
@endsection