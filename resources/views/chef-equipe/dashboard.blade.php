@extends('layouts.backend')

@section('title', 'Tableau de Bord Chef d\'Équipe')

@section('content')
<div class="container mt-5">
    <h2>Bienvenue, {{ auth()->user()->name }}</h2>
    <p>Rôle : Chef d'équipe</p>

    <!-- Mon Équipe -->
    <div class="card mt-4">
        <div class="card-header bg-success text-white">
            Mon Équipe
        </div>
        <div class="card-body">
            @if ($employees->isEmpty())
                <p>Aucun employé dans votre équipe.</p>
            @else
                <ul class="list-group">
                    @foreach ($employees as $employee)
                        <li class="list-group-item">{{ $employee->name }} {{ $employee->prenom }} - {{ $employee->fonction }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <!-- Congés en attente -->
    <div class="card mt-4">
        <div class="card-header bg-warning text-dark">
            Congés en Attente
        </div>
        <div class="card-body">
            @if ($pendingLeaves->isEmpty())
                <p>Aucune demande de congé en attente.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Employé</th>
                            <th>Dates</th>
                            <th>Raison</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendingLeaves as $leave)
                        <tr>
                            <td>{{ $leave->employe->nom }} {{ $leave->employe->prenom }}</td>
                            <td>{{ $leave->date_debut }} → {{ $leave->date_fin }}</td>
                            <td>{{ $leave->raison }}</td>
                            <td>
                                <form action="{{ route('chef-equipe.leaves.approve', $leave) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Accepter</button>
                                </form>
                                <form action="{{ route('chef-equipe.leaves.reject', $leave) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Refuser</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Liens rapides -->
    <div class="mt-4">
        <a href="{{ route('chef-equipe.leaves.create') }}" class="btn btn-primary me-2">
            <i class="fa fa-calendar"></i> Demander un congé
        </a>
        <a href="#" class="btn btn-info">
            <i class="fa fa-tasks"></i> Tâches de mon équipe
        </a>
    </div>
</div>
@endsection