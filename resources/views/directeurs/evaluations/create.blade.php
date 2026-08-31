@extends('layouts.app')
@section('title', 'Ajouter une Évaluation')

@section('content')
    <div class="register-card h-100">

        <h3 class="text-center mb-5">Ajouter une Évaluation</h3>

        <form method="POST" action="{{ route('chef-chantier.evaluations.store') }}">
            @csrf

            <!-- Employé -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-person"></i></span>
                <select name="employee_id" class="form-select" required>
                    <option value="" disabled selected>Sélectionnez un employé</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->nom }} {{ $employee->prenom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Score -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-star"></i></span>
                <input type="number" name="score" min="0" max="20" class="form-control" required placeholder="Score sur 20"
                    value="{{ old('score') }}">
            </div>

            <!-- Commentaire -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-chat-left-text"></i></span>
                <textarea name="commentaire" rows="3" class="form-control"
                    placeholder="Commentaire (facultatif)">{{ old('commentaire') }}</textarea>
            </div>

            <!-- Date -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-calendar"></i></span>
                <input type="date" name="date" class="form-control" required value="{{ old('date') }}">
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
                    <a href="{{ route('chef-chantier.evaluations.index') }}" class="text-success text-decoration-none"
                        style="font-weight:500">
                        Retour à la liste des évaluations
                    </a>
                </p>
            </div>
        </form>
    </div>
@endsection