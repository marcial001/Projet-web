@extends('layouts.backend')

@section('title', 'Liste des Absences')

@section('content')
    <div class="col-md-12 mt-4">
        <div class="mb-3 d-flex justify-content-end align-items-center">
            <input type="text" id="searchInput" class="form-control me-2 bg-light" style="width: 220px;"
                placeholder="Rechercher une absence...">
        </div>
    </div>

    <div class="card p-4">
        <h5>Liste des Absences</h5>

        <table class="table table-bordered table-hover table-success table-striped" id="absencesTable">
            <thead>
                <tr>
                    <th>Employé</th>
                    <th>Date</th>
                    <th>Raison</th>
                    <th>Enregistré par</th>
                </tr>
            </thead>
            <tbody>
                @foreach($absences as $absence)
                    <tr>
                        <td>{{ $absence->employee->name}} {{ $absence->employee->prenom ?? '' }}</td>
                        <td>{{ $absence->date }}</td>
                        <td>{{ $absence->raison }}</td>
                        <td>
                            @php
                                $user = \App\Models\User::find($absence->enregistré_par);
                            @endphp
                            {{ $user ? $user->name : '-' }}
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