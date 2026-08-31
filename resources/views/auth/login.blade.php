@extends('layouts.app')
@section('content')
    <div class="login-card">

        @include('_message')

        <h3 class="text-center mb-5">Connexion</h3>

        <form method="POST" action="{{ route('login') }}">
            {{csrf_field() }}

            <!-- Email Address -->
            <div class="mt-5 input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-envelope"></i></span>
                <input id="email" type="email" class="form-control" name="email" placeholder="Email"
                    autocomplete="username">
            </div>

            <!-- Password -->
            <div class="mt-4  input-group">
                <span class="input-group-text icon-bg-green"><i class="bi bi-lock"></i></span>
                <input id="password" type="password" class="form-control" name="password" placeholder="Mot de passe"
                    required autocomplete="new-password">
            </div>

            <!-- Mot de passe oublié -->
            <div class="mt-3 mb-3">
                <a href="{{ route('password.request') }}" class="text-success text-decoration-none"
                    style="font-size: 0.95em; font-weight: 450;">
                    Mot de passe oublié ?
                </a>
            </div>


            <!-- Remember Me -->
            <div class="mb-3 form-check mt-4">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Se souvenir de moi</label>
            </div>

            <!-- Submit Button -->
            <div class="d-grid mt-5">
                <button type="submit" class="btn btn-success">
                    Se connecter
                </button>
            </div>

            <!-- Not registered? -->
            <div class="mt-4 text-center">
                <p class="text-muted">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-success text-decoration-none" style="font-weight:500">
                        S'inscrire
                    </a>
                </p>
            </div>
        </form>
    </div>

@endsection

   