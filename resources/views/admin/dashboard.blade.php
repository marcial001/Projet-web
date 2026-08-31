<style>
    /* Ajoute ce style dans public/css/app.css ou dans un <style> de ta page layout */
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
</style>

@extends('layouts.backend')

@section('content')


    <div class="col-md-12 mt-3 mb-5">
        <div class="row g-4 justify-content-center">
            <div class="col-md-3">
                <a class="nav-link " href="{{route('users.index')}}">
                    <div class="stat-card stat-blue shadow text-center py-4 rounded-4">
                        <i class="fas fa-user fa-2x mb-2 text-primary"></i>
                        <div class="card-title fw-bold">Nombre d'utilisateurs</div>
                        <div class="stat-value display-6">{{ $totalUsers }}</div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a class="nav-link " href="{{route('employees.index')}}">
                    <div class="stat-card stat-green shadow text-center py-4 rounded-4">
                        <i class="fas fa-users fa-2x mb-2 text-success"></i>
                        <div class="card-title fw-bold">Nombre d'employés</div>
                        <div class="stat-value display-6">{{ $totalEmployees }}</div>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a class="nav-link " href="#">
                    <div class="stat-card stat-yellow shadow text-center py-4 rounded-4">
                        <i class="fas fa-star fa-2x mb-2 text-warning"></i>
                        <div class="card-title fw-bold">Évaluations Récentes</div>
                        <div class="stat-value display-6">{{ $evaluations->count() }}</div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a class="nav-link" href="{{ route('admin.tasks.index') }}">
                    <div class="stat-card stat-blue shadow text-center py-4 rounded-4">
                        <i class="fas fa-tasks fa-2x mb-2 text-primary"></i>
                        <div class="card-title fw-bold">Tâches Assignées</div>
                        <div class="stat-value display-6">{{ $tasks->count() }}</div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-5">
        <div class="row g-4 justify-content-center">
            
            <div class="col-md-3">
                <a class="nav-link" href="{{ route('admin.absences.index') }}">
                    <div class="stat-card stat-red shadow text-center py-4 rounded-4">
                        <i class="fas fa-user-times fa-2x mb-2 text-danger"></i>
                        <div class="card-title fw-bold">Absences Aujourd'hui</div>
                        <div class="stat-value display-6">{{ $absencesToday }}</div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a class="nav-link" href="{{ route('admin.materiels.index') }}">
                    <div class="stat-card stat-green shadow text-center py-4 rounded-4">
                        <i class="fas fa-box fa-2x mb-2 text-success"></i>
                        <div class="card-title fw-bold">Nombre de stock</div>
                        <div class="stat-value display-6">{{ $totalMaterials }}</div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a class="nav-link" href="{{ route('admin.materiels.entrees.index') }}">
                    <div class="stat-card stat-blue shadow text-center py-4 rounded-4">
                        <i class="fas fa-arrow-down fa-2x mb-2 text-primary"></i>
                        <div class="card-title fw-bold">Entrées de matériels</div>
                        <div class="stat-value display-6">{{ $totalEntrees }}</div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a class="nav-link" href="{{ route('admin.materiels.sorties.index') }}">
                    <div class="stat-card stat-red shadow text-center py-4 rounded-4">
                        <i class="fas fa-arrow-up fa-2x mb-2 text-danger"></i>
                        <div class="card-title fw-bold">Sorties de matériels</div>
                        <div class="stat-value display-6">{{ $totalSorties }}</div>
                    </div>
                </a>
            </div>

        </div>





    </div>


@endsection