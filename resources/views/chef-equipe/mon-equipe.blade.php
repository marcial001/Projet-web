@extends('layouts.backend')
@section('title', 'Mon Équipe')

@section('content')
    <div class="col-md-12 mt-4">
        <div class="mb-3 d-flex justify-content-end align-items-center">
            <input type="text" id="searchInput" class="form-control me-2 bg-light" style="width: 220px;"
                placeholder="Rechercher un membre...">
        </div>
    </div>

    <div class="card p-4">
        <h5>Mon Équipe</h5>

        @if ($employees->isEmpty())
            <p>Aucun employé dans votre équipe.</p>
        @else
            <table class="table table-bordered table-hover table-success table-striped" id="teamTable">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Fonction</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->name ?? $employee->name }}</td>
                            <td>{{ $employee->prenom }}</td>
                            <td>{{ $employee->fonction }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#teamTable tbody tr');
            rows.forEach(function (row) {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
@endsection