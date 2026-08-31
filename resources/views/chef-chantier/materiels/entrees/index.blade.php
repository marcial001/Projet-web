@extends('layouts.backend')
@section('content')
    <div class="col-md-12 mt-4">
        <div class="mb-3 d-flex justify-content-end align-items-center">
            <input type="text" id="searchInputEntree" class="form-control me-2 bg-light" style="width: 220px;"
                placeholder="Rechercher une entrée...">
        </div>
    </div>

    <div class="card p-4">
        <h5>Liste des entrées de matériels</h5>
        <table class="table table-bordered table-hover table-success table-striped" id="entreesTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Matériel</th>
                    <th>Quantité</th>
                    <th>Fournisseur</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entrees as $entree)
                    <tr>
                        <td>{{ $entree->id }}</td>
                        <td>{{ $entree->material->nom ?? '' }}</td>
                        <td>{{ $entree->quantite }}</td>
                        <td>{{ $entree->fournisseur }}</td>
                        <td>{{ $entree->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('searchInputEntree').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#entreesTable tbody tr');
            rows.forEach(function (row) {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
@endsection