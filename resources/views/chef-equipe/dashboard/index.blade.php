@extends('layouts.backend')

@section('title', 'Tableau de Bord Chef d\'Équipe')

@section('content')
    <div class="container mt-5">
        
        <!-- Congés en attente -->
        <div class="card p-4 mt-4">
            <h5>Congés en Attente</h5>
            @if ($pendingLeaves->isEmpty())
                <div class="alert alert-info mb-0">Aucune demande de congé en attente.</div>
            @else
                <table class="table table-bordered table-hover table-success table-striped" id="pendingLeavesTable">
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
                                <td>{{ $leave->employee->name ?? $leave->employee->name }} {{ $leave->employee->prenom }}</td>
                                <td>{{ $leave->date_debut }} → {{ $leave->date_fin }}</td>
                                <td>{{ Str::limit($leave->raison, 100) }}</td>
                                <td>
                                    <form action="{{ route('chef-equipe.leaves.approve', $leave) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Accepter</button>
                                    </form>
                                    <form action="{{ route('chef-equipe.leaves.reject', $leave) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger ms-2">Refuser</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Liens rapides -->
        <div class="mt-4 d-flex justify-content-center gap-3">
            <a href="{{ route('chef-equipe.leaves.create') }}" class="btn btn-primary me-2">
                <i class="fa fa-calendar"></i> Demander un congé
            </a>
            <a href="#" class="btn btn-info">
                <i class="fa fa-tasks"></i> Tâches de mon équipe
            </a>
        </div>
    </div>
@endsection