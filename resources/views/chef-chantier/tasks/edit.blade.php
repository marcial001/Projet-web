@extends('layouts.app')
@section('title', 'Modifier une Tâche')

@section('content')
    <div class="register-card h-100">

        <h3 class="text-center mb-5">Modifier une Tâche</h3>

        <form method="POST" action="{{ route('chef-chantier.tasks.update', $task) }}">
            @csrf
            @method('PUT')

            <!-- Employé -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-person"></i></span>
                <select name="employee_id" class="form-select" required>
                    <option value="" disabled>Sélectionnez un employé</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $task->employee_id == $employee->id ? 'selected' : '' }}>
                            {{ $employee->nom }} {{ $employee->prenom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Titre -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-card-text"></i></span>
                <input type="text" name="titre" class="form-control" placeholder="Titre" required value="{{ old('titre', $task->titre) }}">
            </div>

            <!-- Description -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-file-earmark-text"></i></span>
                <textarea name="description" class="form-control" placeholder="Description (facultatif)">{{ old('description', $task->description) }}</textarea>
            </div>

            <!-- Statut -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-flag"></i></span>
                <select name="statut" class="form-select">
                    <option value="en attente" {{ $task->statut == 'en attente' ? 'selected' : '' }}>En Attente</option>
                    <option value="en cours" {{ $task->statut == 'en cours' ? 'selected' : '' }}>En Cours</option>
                    <option value="terminée" {{ $task->statut == 'terminée' ? 'selected' : '' }}>Terminée</option>
                </select>
            </div>

            <!-- Remarque -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-chat-left-text"></i></span>
                <textarea name="remarque" class="form-control" placeholder="Remarque">{{ old('remarque', $task->remarque) }}</textarea>
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
                    <a href="{{ route('chef-chantier.tasks.index') }}" class="text-success text-decoration-none"
                        style="font-weight:500">
                        Retour à la liste des tâches
                    </a>
                </p>
            </div>
        </form>
    </div>
@endsection