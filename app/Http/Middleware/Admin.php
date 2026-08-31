<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'Accès interdit : vous devez être administrateur.');
    }

        /* $rolesAutorises= ['admin', 'chef_chantier', 'chef_equipe', 'directeurs'];

        $user = Auth::user();
        if (!$user || !in_array($user->role, $rolesAutorises)) {
            return redirect()->route('welcome')->with('error', 'You do not have access to this page.');
        }; */
    
        return $next($request); 
    }
}
