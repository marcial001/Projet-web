@extends('layouts.backend')
@section('title', 'Détails du Congé')

@section('content')
<div class="container mt-5">
    <h3>Détails du Congé</h3>
    <ul class="list-group">
        <li class="list-group-item"><strong>Employé :</strong> {{ $leave->employe->name }} {{ $leave->employe->prenom }}</li>
        <li class="list-group-item"><strong>Dates :</strong> {{ $leave->date_debut }} → {{ $leave->date_fin }}</li>
        <li class="list-group-item"><strong>Raison :</strong> {{ $leave->raison }}</li>
        <li class="list-group-item"><strong>Statut :</strong>
            @switch($leave->statut)
                @case('en attente') <span class="badge bg-warning text-dark">En Attente</span> @break
                @case('accepté') <span class="badge bg-success">Accepté</span> @break
                @case('refusé') <span class="badge bg-danger">Refusé</span> @break
            @endswitch
        </li>
        <li class="list-group-item"><strong>Chef d’équipe :</strong> {{ optional($leave->employe->chefEquipe)->name ?? 'Aucun' }}</li>
    </ul>
    <a href="{{ route('chef-equipe.leaves.index') }}" class="btn btn-secondary mt-3">Retour</a>
</div>
@endsection