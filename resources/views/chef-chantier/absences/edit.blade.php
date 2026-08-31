@extends('layouts.app')
@section('title', 'Modifier une Absence')

@section('content')
    <div class="register-card h-100">

        <h3 class="text-center mb-5">Modifier l'absence</h3>

        <form method="POST" action="{{ route('chef-chantier.absences.update', $absence) }}">
            @csrf
            @method('PUT')

            <!-- Employé -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-person"></i></span>
                <select name="employee_id" class="form-select" required>
                    <option value="" disabled>Sélectionnez un employé</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $employee->id == $absence->employee_id ? 'selected' : '' }}>
                            {{ $employee->name }} {{ $employee->prenom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Date -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-calendar"></i></span>
                <input type="date" name="date" class="form-control" required value="{{ old('date', $absence->date) }}">
            </div>

            <!-- Raison -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-chat-left-text"></i></span>
                <textarea name="raison" rows="3" class="form-control" placeholder="Raison" required>{{ old('raison', $absence->raison) }}</textarea>
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
                    <a href="{{ route('chef-chantier.absences.index') }}" class="text-success text-decoration-none"
                        style="font-weight:500">
                        Retour à la liste des absences
                    </a>
                </p>
            </div>
        </form>
    </div>
@endsection