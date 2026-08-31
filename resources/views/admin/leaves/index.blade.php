{{-- filepath: resources/views/admin/leaves/index.blade.php --}}
@extends('layouts.backend')
@section('title', 'Liste des Congés')

@section('content')
<div class="card p-4 mt-4">
    <h5>Liste des Congés</h5>
    <table class="table table-bordered table-hover table-success table-striped">
        <thead>
            <tr>
                <th>Employé</th>
                <th>Dates</th>
                <th>Raison</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leaves as $leave)
                <tr>
                    <td>{{ $leave->employee->name ?? $leave->employee->name }} {{ $leave->employee->prenom }}</td>
                    <td>{{ $leave->date_debut }} → {{ $leave->date_fin }}</td>
                    <td>{{ Str::limit($leave->raison, 100) }}</td>
                    <td>
                        @switch($leave->statut)
                            @case('en attente') <span class="badge bg-warning text-dark">En Attente</span> @break
                            @case('accepté') <span class="badge bg-success">Accepté</span> @break
                            @case('refusé') <span class="badge bg-danger">Refusé</span> @break
                            @default <span class="badge bg-secondary">{{ ucfirst($leave->statut) }}</span>
                        @endswitch
                    </td>
                    <td>
                        @if($leave->statut === 'en attente')
                            <form action="{{ route('admin.leaves.approve', $leave) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approuver</button>
                            </form>
                            <form action="{{ route('admin.leaves.reject', $leave) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Rejeter</button>
                            </form>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection