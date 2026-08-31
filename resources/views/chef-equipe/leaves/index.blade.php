@extends('layouts.backend')
@section('title', 'Liste des Congés')

@section('content')
    <div class="col-md-12 mt-4">
        <div class="mb-3 d-flex justify-content-end align-items-center">
            <input type="text" id="searchInput" class="form-control me-2 bg-light" style="width: 220px;"
                placeholder="Rechercher un congé...">
            <a href="{{ route('chef-equipe.leaves.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Nouveau Congé
            </a>
        </div>
    </div>

    <div class="card p-4">
        <h5>Mes Demandes de Congés</h5>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-hover table-success table-striped" id="leavesTable">
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
                            <a href="{{ route('chef-equipe.leaves.edit', $leave) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('chef-equipe.leaves.destroy', $leave) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Êtes-vous sûr ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger ms-2">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#leavesTable tbody tr');
            rows.forEach(function (row) {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
@endsection