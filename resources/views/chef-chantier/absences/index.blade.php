@extends('layouts.backend')
@section('title', 'Liste des Absences')

@section('content')
    <div class="col-md-12 mt-4">
        <div class="mb-3 d-flex justify-content-end align-items-center">
            <input type="text" id="searchInput" class="form-control me-2 bg-light" style="width: 220px;"
                placeholder="Rechercher une absence...">
            <a href="{{ route('chef-chantier.absences.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Nouvelle Absence
            </a>
        </div>
    </div>

    <div class="card p-4">
        <h5>Mes Enregistrements d’Absences</h5>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-hover table-success table-striped" id="absencesTable">
            <thead>
                <tr>
                    <th>Employé</th>
                    <th>Date</th>
                    <th>Raison</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absences as $absence)
                    <tr>
                        <td>{{ $absence->employee->nom }} {{ $absence->employee->prenom }}</td>
                        <td>{{ $absence->date }}</td>
                        <td>{{ $absence->raison }}</td>
                        <td>
                            <a href="{{ route('chef-chantier.absences.edit', $absence) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('chef-chantier.absences.destroy', $absence) }}" method="POST" style="display:inline;"
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
            let rows = document.querySelectorAll('#absencesTable tbody tr');
            rows.forEach(function (row) {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
@endsection