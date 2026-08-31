{{-- filepath: resources/views/admin/tasks/index.blade.php --}}
@extends('layouts.backend')

@section('title', 'Liste des Tâches')

@section('content')
    <div class="col-md-12 mt-4">
        <div class="mb-3 d-flex justify-content-end align-items-center">
            <input type="text" id="searchInput" class="form-control me-2 bg-light" style="width: 220px;"
                placeholder="Rechercher une tâche...">
        </div>
    </div>

    <div class="card p-4">
        <h5>Liste des Tâches</h5>

        <table class="table table-bordered table-hover table-success table-striped" id="tasksTable">
            <thead>
                <tr>
                    <th>Employé</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Attribué par</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->employee->name }} {{ $task->employee->prenom }}</td>
                        <td>{{ $task->titre }}</td>
                        <td>{{ $task->description }}</td>
                        <td>
                            @php
                                $user = \App\Models\User::find($task->attribue_par);
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
            let rows = document.querySelectorAll('#tasksTable tbody tr');
            rows.forEach(function (row) {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
@endsection