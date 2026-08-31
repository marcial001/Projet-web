@extends('layouts.app')
@section('title', 'Nouvelle Entrée de Matériel')

@section('content')
<div class="container mt-5">
    <h3>Nouvelle Entrée de Matériel</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('materiels.entree.store') }}">
        @csrf

        <div class="mb-3">
            <label for="material_id">Type de Matériel</label>
            <select name="material_id" id="material_id" class="form-control" required>
                @foreach ($materials as $mat)
                    <option value="{{ $mat->id }}">{{ $mat->nom }} ({{ $mat->type }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantite">Quantité reçue</label>
            <input type="number" name="quantite" id="quantite" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label for="fournisseur">Fournisseur</label>
            <input type="text" name="fournisseur" id="fournisseur" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer l’entrée</button>
    </form>
</div>
@endsection