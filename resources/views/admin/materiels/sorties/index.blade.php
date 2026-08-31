@extends('layouts.backend')
@section('content')
    <div class="col-md-12 mt-4">
        <div class="mb-3 d-flex justify-content-end align-items-center">
            <input type="text" id="searchInputSortie" class="form-control bg-light" style="width: 220px;"
                placeholder="Rechercher une sortie...">
            <a href="{{ route('chef-chantier.materiels.sorties.create') }}" class="btn btn-success me-2">
                <i class="fa fa-plus"></i> Nouvelle sortie
            </a>
        </div>
    </div>

    <div class="card p-4">
        <h5>Liste des sorties de matériels</h5>
        <table class="table table-bordered table-hover table-success table-striped" id="sortiesTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Matériel</th>
                    <th>Quantité</th>
                    <th>Employé</th>
                    <th>Raison</th>
                    <th>Chef de chantier</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sorties as $sortie)
                    <tr>
                        <td>{{ $sortie->id }}</td>
                        <td>{{ $sortie->material->nom ?? '' }}</td>
                        <td>{{ $sortie->quantite }}</td>
                        <td>
                            @if($sortie->destinataire)
                                {{ $sortie->destinataire->name }} {{ $sortie->destinataire->prenom }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $sortie->raison }}</td>
                        <td>{{ $sortie->chefChantier->name ?? '' }}</td>
                        <td>{{ $sortie->date_sortie ? \Carbon\Carbon::parse($sortie->date_sortie)->format('d/m/Y') : '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('searchInputSortie').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#sortiesTable tbody tr');
            rows.forEach(function (row) {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
@endsection