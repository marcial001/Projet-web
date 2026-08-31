@extends('layouts.app')
@section('content')
    <div class="welcome-card">
        <!-- Icône de bienvenue -->
        <div class="welcome-icon mt-4">
            <i class="bi bi-arrow-up"></i> <!-- Icône personnalisée, à adapter selon l'image -->
        </div>

        <!-- Titre et sous-titre -->
        <h2 class="h4 mb-3 text-center">Bienvenue</h2>
        <p class="text-muted mb-5 mt-3 text-center">Rejoignez notre communauté dès aujourd'hui</p>

        <!-- Boutons d'action -->
        <div class="mb-3 mt-4">
            <a href="{{url('registration')}}" class="btn btn-success btn-custom w-100 mb-2">S'inscrire</a>
            <a href="{{url('login')}}" class="btn btn-outline-success btn-custom w-100 mt-2">Se connecter</a>
        </div>
        <div class="mt-5 mb-5">
            .
        </div>
@endsection