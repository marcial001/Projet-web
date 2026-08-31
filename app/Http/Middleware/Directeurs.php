<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Directeurs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    
{
    if (!Auth::check() || Auth::user()->role !== 'directeurs') {
        abort(403, 'Accès interdit : vous devez être directeur.');
    }

    return $next($request);
}
    
}
