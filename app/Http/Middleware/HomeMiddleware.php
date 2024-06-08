<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el usuario está autenticado y su correo electrónico está verificado
        if (Auth::check() && Auth::user()->email_verified_at) {
            return $next($request);
        }
        
        // Si el usuario no está autenticado o su correo electrónico no está verificado, redirígelo a la página de espera
        return redirect()->route('espera');
    }
}
