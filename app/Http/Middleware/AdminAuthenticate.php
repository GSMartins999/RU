<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o admin está autenticado
        if (!Auth::guard('admin')->check()) {
            // Se não estiver, redireciona para a tela de login do admin
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
