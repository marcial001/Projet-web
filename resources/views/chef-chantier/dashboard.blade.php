{{-- filepath: c:\Users\Hp\ali\resources\views\chef-chantier\dashboard.blade.php --}}
@extends('layouts.backend')

@section('title', 'Tableau de Bord Chef de Chantier')

@section('content')
    <style>
        .stat-card {
            background: #f8f5f5;
            border-radius: 1rem;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
            transition: transform 0.15s;
        }

        .stat-card:hover {
            transform: translateY(-4px) scale(1.03);
        }

        .stat-blue {
            border-top: 4px solid #007bff;
        }

        .stat-red {
            border-top: 4px solid #dc3545;
        }

        .stat-yellow {
            border-top: 4px solid #ffc107;
        }

        .stat-green {
            border-top: 4px solid #229954;
        }
    </style>

    <div class="container mt-4">

        <h2>Statistiques</h2>

        <div class="col-md-12 mt-3 mb-5">
            <div class="row g-4 justify-content-center">
                <div class="col-md-3">
                    <div class="stat-card stat-green shadow text-center py-4 rounded-4">
                        <a class="nav-link" href="{{ route('chef-chantier.employees.index') }}">
                            <i class="fas fa-users fa-2x mb-2 text-success"></i>
                            <div class="card-title fw-bold">employés</div>
                            <div class="stat-value display-6">{{ $employees->count() }}</div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-blue shadow text-center py-4 rounded-4">
                        <a class="nav-link " href="{{route('chef-chantier.tasks.index')}}">
                            <i class="fas fa-tasks fa-2x mb-2 text-primary"></i>
                            <div class="card-title fw-bold">Tâches Assignées</div>
                            <div class="stat-value display-6">{{ $tasks->count() }}</div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-red shadow text-center py-4 rounded-4">
                        <a class="nav-link " href="{{route('chef-chantier.absences.index')}}">
                            <i class="fas fa-user-times fa-2x mb-2 text-danger"></i>
                            <div class="card-title fw-bold">Absences Aujourd'hui</div>
                            <div class="stat-value display-6">{{ $absencesToday }}</div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-yellow shadow text-center py-4 rounded-4">
                        <a class="nav-link " href="{{route('chef-chantier.evaluations.index')}}">
                            <i class="fas fa-star fa-2x mb-2 text-warning"></i>
                            <div class="card-title fw-bold">Évaluations Récentes</div>
                            <div class="stat-value display-6">{{ $evaluations->count() }}</div>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center gap-2">
            <a href="{{ route('chef-chantier.tasks.create') }}" class="btn btn-success m-1">Créer une tâche</a>
            <a href="{{ route('chef-chantier.absences.create') }}" class="btn btn-secondary m-1">Marquer une absence</a>
            <a href="{{ route('chef-chantier.evaluations.create') }}" class="btn btn-info m-1">Évaluer un employé</a>
        </div>
    </div>
@endsection