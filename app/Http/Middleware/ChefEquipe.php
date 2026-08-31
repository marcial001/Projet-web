<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ChefEquipe
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
   {
       if (!Auth::check() || Auth::user()->role !== 'chef_equipe') {
           abort(403, 'Accès interdit : vous devez être chef d’équipe.');
       }

    return $next($request);
}
}
