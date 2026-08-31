@extends('layouts.backend')
@section('title', 'Liste des Utilisateurs')

@section('content')
    <div class="col-md-12 mt-4">
        <!-- Zone de recherche et bouton alignés à droite -->
        <div class="mb-3 d-flex justify-content-end align-items-center">
            <input type="text" id="searchInput" class="form-control me-2 bg-light" style="width: 220px;"
                placeholder="Rechercher un utilisateur...">
            <a href="{{ route('users.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Ajouter
            </a>
        </div>
    </div>

    <div class="card p-4">
        <h5>Liste des utilisateurs</h5>
        <table class="table table-bordered table-hover table-success table-striped" id="usersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Rôle</th>
                  
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? '-' }}</td>
                        <td>{{ $user->role }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Script de recherche en temps réel -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#usersTable tbody tr');
            rows.forEach(function (row) {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
@endsection