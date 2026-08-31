@extends('layouts.backend')
@section('content')
    <div class="col-md-12 mt-4">
        <!-- Zone de recherche et bouton alignés à droite -->
        <div class="mb-3 d-flex justify-content-end align-items-center">
            <input type="text" id="searchInput" class="form-control me-2 bg-light" style="width: 220px;"
                placeholder="Rechercher un Utilisaateurs...">
            <a href="{{ route('users.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Ajouter
            </a>
        </div>
    </div>

    <div class="card p-4">
        <h5>liste d'utilisateurs</h5>

        <table class="table table-bordered table-hover table-success table-striped" id="usersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($getRecord as $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->email}}</td>
                        <td>{{$value->phone}}</td>
                        <td>{{$value->role}}</td>
                        <td>
                            <a href="{{ route('users.edit', $value) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('users.destroy', $value) }}" method="POST" style="display:inline;"
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