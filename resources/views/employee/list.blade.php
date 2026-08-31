@extends('layouts.backend')

@section('content')

@section('content')
    <div class="col-md-12 mt-3">
        <!-- Zone de recherche et bouton alignés à droite -->
        <div class="mb-3 d-flex justify-content-end align-items-center">
            <input type="text" id="searchInput" class="form-control me-2 bg-light" style="width: 220px;"
                   placeholder="Rechercher un employé...">
            <a href="{{ route('employees.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Ajouter
            </a>
        </div>

        <div class="card p-4">
            <h5>Liste des Employés</h5>

            <table class="table table-bordered table-hover table-success table-striped" id="employeesTable" style="background-color:#c1dbd3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Fonction</th>
                        <th>Chef de Chantier</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->name }} {{ $employee->prenom }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->fonction }}</td>
                            <td>{{ optional($employee->chefChantier)->name}}</td>
                            <td>
                                <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('employees.destroy', $employee) }}" method="POST"
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
    </div>

    <!-- Script de recherche en temps réel -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#employeesTable tbody tr');
            rows.forEach(function (row) {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
@endsection

@endsection