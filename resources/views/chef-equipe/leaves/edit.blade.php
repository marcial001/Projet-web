@extends('layouts.app')
@section('title', 'Modifier un Congé')

@section('content')
<div class="container mt-5">
    <h3>Modifier un Congé</h3>
    <form method="POST" action="{{ route('chef-equipe.leaves.update', $leave) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Employé</label>
            <select name="employee_id" class="form-control" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $employee->id == $leave->employee_id ? 'selected' : '' }}>
                        {{ $employee->name }} {{ $employee->prenom }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Date de début</label>
            <input type="date" name="date_debut" value="{{ old('date_debut', $leave->date_debut) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Date de fin</label>
            <input type="date" name="date_fin" value="{{ old('date_fin', $leave->date_fin) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Raison</label>
            <textarea name="raison" rows="3" class="form-control">{{ old('raison', $leave->raison) }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Mettre à jour</button>
    </form>
</div>
@endsection