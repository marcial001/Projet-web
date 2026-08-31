@extends('layouts.backend')
@section('title', 'Rapports')

@section('content')
<div class="container mt-5">
    <h3>Rapports disponibles</h3>

    <div class="list-group">
        <a href="{{ route('directeur.rapports.show', 'employés') }}" class="list-group-item list-group-item-action">📊 Employés</a>
        <a href="{{ route('directeur.rapports.show', 'tâches') }}" class="list-group-item list-group-item-action">📅 Tâches</a>
        <a href="{{ route('directeur.rapports.show', 'absences') }}" class="list-group-item list-group-item-action">📆 Absences</a>
        <a href="{{ route('directeur.rapports.show', 'conges') }}" class="list-group-item list-group-item-action">🗓️ Congés</a>
    </div>
</div>
@endsection