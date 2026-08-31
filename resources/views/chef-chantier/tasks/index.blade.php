@extends('layouts.backend')
@section('content')
    <div class="col-md-12 mt-4">
        <!-- Zone de recherche et bouton alignés à droite -->
        <div class="mb-3 d-flex justify-content-end align-items-center">
            <input type="text" id="searchInput" class="form-control me-2 bg-light" style="width: 220px;"
                placeholder="Rechercher une tâche...">
            <a href="{{ route('chef-chantier.tasks.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Ajouter
            </a>
        </div>
    </div>

    <div class="card p-4">
        <h5>Liste des tâches</h5>

        <table class="table table-bordered table-hover table-success table-striped" id="tasksTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Employé</th>
                    <th>Statut</th>
                    <th>Remarque</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->titre }}</td>
                        <td>{{ optional($task->employee)->name }} {{ optional($task->employee)->prenom }}</td>
                        <td>{{ $task->statut }}</td>
                        <td>{{ $task->remarque }}</td>
                        <td>
                            <a href="{{ route('chef-chantier.tasks.edit', $task) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('chef-chantier.tasks.destroy', $task) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">
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
            let rows = document.querySelectorAll('#tasksTable tbody tr');
            rows.forEach(function (row) {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
@endsection