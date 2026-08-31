
@extends('layouts.app')
@section('title', 'Détails de l\'employé')

@section('content')

   <!-- Carte Ajouter Employé -->
            <div class="col-md-4 mb-4">
                <div class="card card-green">
                    <div class="card-body">
                        <i class="fas fa-user-plus"></i>
                        <h5 class="card-title">Nombre d'employés</h5>
                        <div>{{$totalEmployees}}</div>
                    </div>
                </div>
            </div>
@endsection


