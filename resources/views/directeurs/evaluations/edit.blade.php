@extends('layouts.app')
@section('title', 'Modifier une Évaluation')

@section('content')
    <div class="register-card h-100">

        <h3 class="text-center mb-5">Modifier l'évaluation</h3>

        <form method="POST" action="{{ route('chef-chantier.evaluations.update', $evaluation) }}">
            @csrf
            @method('PUT')

            <!-- Employé -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-person"></i></span>
                <select name="employee_id" class="form-select" required>
                    <option value="" disabled>Sélectionnez un employé</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $employee->id == $evaluation->employee_id ? 'selected' : '' }}>
                            {{ $employee->name }} {{ $employee->prenom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Score -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-star"></i></span>
                <input type="number" name="score" min="0" max="20" class="form-control" required placeholder="Score sur 20"
                    value="{{ old('score', $evaluation->score) }}">
            </div>

            <!-- Commentaire -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-chat-left-text"></i></span>
                <textarea name="commentaire" rows="3" class="form-control"
                    placeholder="Commentaire (facultatif)">{{ old('commentaire', $evaluation->commentaire) }}</textarea>
            </div>

            <!-- Date -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-calendar"></i></span>
                <input type="date" name="date" class="form-control" required value="{{ old('date', $evaluation->date) }}">
            </div>

            <!-- Bouton enregistrer -->
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-success">
                    Mettre à jour
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