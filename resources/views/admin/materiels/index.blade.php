@extends('layouts.backend')
@section('content')
    <div class="col-md-12 mt-4">
        <!-- Zone de recherche et bouton alignés à droite -->
        <div class="mb-3 d-flex justify-content-end align-items-center">
            <input type="text" id="searchInput" class="form-control me-2 bg-light" style="width: 220px;"
                placeholder="Rechercher un matériel...">
            <a href="{{ route('admin.materiels.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Ajouter
            </a>
        </div>
    </div>

    <div class="card p-4">
        <h5>Liste des Stock</h5>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-hover table-success table-striped" id="materielsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Quantité Disponible</th>
                    <th>Localisation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materials as $mat)
                    <tr>
                        <td>{{ $mat->id }}</td>
                        <td>{{ $mat->nom }}</td>
                        <td>{{ $mat->type }}</td>
                        <td>{{ $mat->quantite_disponible }}</td>
                        <td>{{ $mat->localisation ?? '-' }}</td>
                        <td>
                            {{-- Exemple de boutons d'action (à adapter selon tes routes) --}}
                            <a href="#" class="btn btn-sm btn-warning" title="Modifier">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="#" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger ms-2" title="Supprimer">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Script de recherche en temps réel -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#materielsTable tbody tr');
            rows.forEach(function (row) {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
@endsection