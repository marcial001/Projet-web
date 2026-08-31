@extends('layouts.app')
@section('content')
    <div class="forgot-card">
        <h3 class="text-center mb-5">Mot de passe oublié</h3>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ url('forgot-password') }}">
            {{csrf_field()}}

            <div class="mt-5 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-envelope"></i></span>
                <input id="email" type="email" class="form-control" name="email" placeholder="Votre email" required autofocus autocomplete="email" value="{{ old('email') }}">
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-success">
                    Envoyer le lien de réinitialisation
                </button>
            </div>

            <div class="mt-4 text-center">
                <a href="{{ route('login') }}" class="text-success text-decoration-none" style="font-weight:500">
                    Retour à la connexion
                </a>
            </div>
        </form>
    </div>
@endsection