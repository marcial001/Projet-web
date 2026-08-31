@extends('layouts.backend')
@section('title', 'Liste des Évaluations')

@section('content')
    <div class="col-md-12 mt-4">
        <div class="mb-3 d-flex justify-content-end align-items-center">
            <input type="text" id="searchInput" class="form-control me-2 bg-light" style="width: 220px;"
                placeholder="Rechercher une évaluation...">
            <a href="{{ route('chef-chantier.evaluations.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Nouvelle Évaluation
            </a>
        </div>
    </div>

    <div class="card p-4">
        <h5>Mes Enregistrements d’Évaluations</h5>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-hover table-success table-striped" id="evaluationsTable">
            <thead>
                <tr>
                    <th>Employé</th>
                    <th>Score</th>
                    <th>Date</th>
                    <th>Commentaire</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evaluations as $evaluation)
                    <tr>
                        <td>{{ $evaluation->employee->name }} {{ $evaluation->employee->prenom }}</td>
                        <td>{{ $evaluation->score }}/20</td>
                        <td>{{ $evaluation->date }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($evaluation->commentaire, 50) }}</td>
                        <td>
                            <a href="{{ route('chef-chantier.evaluations.edit', $evaluation) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('chef-chantier.evaluations.destroy', $evaluation) }}" method="POST"
                                style="display:inline;" onsubmit="return confirm('Êtes-vous sûr ?')">
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
            let rows = document.querySelectorAll('#evaluationsTable tbody tr');
            rows.forEach(function (row) {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
@endsection