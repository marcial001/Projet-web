@extends('layouts.backend')
@section('title', 'Tableau de Bord Directeur')

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
        border-top: 4px solid #28a745;
    }
    .stat-primary {
        border-top: 4px solid #0d6efd;
    }
</style>

<div class="col-md-12 mt-3 mb-5">
    <div class="row g-4 justify-content-center mt-3">
        <div class="col-md-3">
            <div class="stat-card stat-green shadow text-center py-4 rounded-4">
                <a class="nav-link" href="{{ route('directeur.employees.index') }}">
                    <i class="fas fa-users fa-2x mb-2 text-success"></i>
                    <div class="card-title fw-bold">Employés</div>
                    <div class="stat-value display-6">{{ $employeeCount }}</div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card stat-blue shadow text-center py-4 rounded-4">
                <a class="nav-link" href="{{ route('directeur.users.index') }}">
                    <i class="fas fa-user fa-2x mb-2 text-primary"></i>
                    <div class="card-title fw-bold">Utilisateurs</div>
                    <div class="stat-value display-6">{{ $usersCount }}</div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card stat-yellow shadow text-center py-4 rounded-4">
                <a class="nav-link" href="{{ route('directeur.evaluations.index') }}">
                    <i class="fas fa-star fa-2x mb-2 text-warning"></i>
                    <div class="card-title fw-bold">Évaluations</div>
                    <div class="stat-value display-6">{{ $evaluationsCount }}</div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card stat-blue shadow text-center py-4 rounded-4">
                <a class="nav-link" href="{{ route('directeur.tasks.index') }}">
                    <i class="fas fa-tasks fa-2x mb-2 text-primary"></i>
                    <div class="card-title fw-bold">Tâches</div>
                    <div class="stat-value display-6">{{ $tasksCount }}</div>
                </a>
            </div>
        </div>
        <div class="col-md-3 ">
            <div class="stat-card stat-red shadow text-center py-4 rounded-4">
                <a class="nav-link" href="{{ route('directeur.absences.index') }}">
                    <i class="fas fa-user-times fa-2x mb-2 text-danger"></i>
                    <div class="card-title fw-bold">Absences</div>
                    <div class="stat-value display-6">{{ $absencesCount }}</div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card stat-green shadow text-center py-4 rounded-4">
                <a class="nav-link" href="{{ route('directeur.leaves.index') }}">
                    <i class="fas fa-calendar-alt fa-2x mb-2 text-success"></i>
                    <div class="card-title fw-bold">Congés</div>
                    <div class="stat-value display-6">{{ $leavesCount }}</div>
                </a>
            </div>
        </div>

    </div>
</div>
@endsection