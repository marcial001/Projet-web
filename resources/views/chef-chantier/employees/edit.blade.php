@extends('layouts.app')
@section('title', 'Modifier un Employé')

@section('content')
    <div class="register-card h-100">
        <h3 class="text-center mb-5">Modifier un Employé</h3>
        <form method="POST" action="{{ route('chef-chantier.employees.update', $employee) }}">
            @csrf
            @method('PUT')

            <!-- Nom -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-person"></i></span>
                <input type="text" name="name" class="form-control" placeholder="Nom" required value="{{ old('name', $employee->name) }}">
            </div>

            <!-- Prénom -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-person"></i></span>
                <input type="text" name="prenom" class="form-control" placeholder="Prénom" required value="{{ old('prenom', $employee->prenom) }}">
            </div>

            <!-- Numéro de téléphone -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-telephone"></i></span>
                <input type="tel" name="phone" class="form-control" placeholder="Numéro de téléphone" value="{{ old('phone', $employee->phone) }}">
            </div>

            <!-- Fonction -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-briefcase"></i></span>
                <input type="text" name="fonction" class="form-control" placeholder="Fonction" required value="{{ old('fonction', $employee->fonction) }}">
            </div>

            <!-- Chef d'équipe (optionnel) -->
            <div class="mb-4 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-person-badge"></i></span>
                <select name="chef_equipe_id" class="form-select">
                    <option value="">Aucun chef d'équipe</option>
                    @foreach($chefsEquipe as $chef)
                        <option value="{{ $chef->id }}" {{ old('chef_equipe_id', $employee->chef_equipe_id) == $chef->id ? 'selected' : '' }}>
                            {{ $chef->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
        </form>
    </div>
@endsection