@extends('layouts.app')
@section('title', 'Demander un Congé')

@section('content')
    <div class="register-card h-100">

        <h3 class="text-center mb-5">Demander un Congé</h3>

        <form method="POST" action="{{ route('chef-equipe.leaves.store') }}">
            @csrf

            <!-- Employé -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="fa fa-user"></i></span>
                <select name="employee_id" class="form-select" required>
                    <option value="" disabled selected>Sélectionnez un employé</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name ?? $employee->name }} {{ $employee->prenom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dates -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="fa fa-calendar"></i></span>
                <input type="date" name="date_debut" class="form-control" required value="{{ old('date_debut') }}">
                <span class="input-group-text">→</span>
                <input type="date" name="date_fin" class="form-control" required value="{{ old('date_fin') }}">
            </div>

            <!-- Raison -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="fa fa-comment"></i></span>
                <textarea name="raison" rows="3" class="form-control" placeholder="Raison" required>{{ old('raison') }}</textarea>
            </div>

            <!-- Bouton enregistrer -->
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-success">
                    Envoyer la demande
                </button>
            </div>

            <!-- Retour à la liste -->
            <div class="mt-3 text-center">
                <p class="text-muted">
                    <a href="{{ route('chef-equipe.leaves.index') }}" class="text-success text-decoration-none"
                        style="font-weight:500">
                        Retour à la liste des congés
                    </a>
                </p>
            </div>
        </form>
    </div>
@endsection