{{-- filepath: resources/views/directeurs/leaves/index.blade.php --}}
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
            </tr>
        </thead>
        <tbody>
            @foreach ($leaves as $leave)
                <tr>
                    <td>
                        @if($leave->employee)
                            {{ $leave->employee->name ?? '-' }} {{ $leave->employee->prenom ?? '' }}
                        @else
                            <span class="text-danger">Aucun employé</span>
                        @endif
                    </td>
                    <td>{{ $leave->date_debut }} → {{ $leave->date_fin }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($leave->raison, 100) }}</td>
                    <td>
                        @switch($leave->statut)
                            @case('en attente') <span class="badge bg-warning text-dark">En Attente</span> @break
                            @case('accepté') <span class="badge bg-success">Accepté</span> @break
                            @case('refusé') <span class="badge bg-danger">Refusé</span> @break
                            @default <span class="badge bg-secondary">{{ ucfirst($leave->statut) }}</span>
                        @endswitch
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection