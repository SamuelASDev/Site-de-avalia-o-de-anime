<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar se o usuário autenticado tem o nível "admin"
        if (auth()->check() && auth()->user()->nivel !== 'admin') {
            return redirect('/');  // Redirecionar para a página inicial se não for admin
        }

        return $next($request);
    }
}
