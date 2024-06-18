<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    // Middleware om te controleren of de gebruiker een van de opgegeven rollen heeft
    public function handle($request, Closure $next, ...$roles)
    {
        // Controleer of de gebruiker ingelogd is
        if (!Auth::check()) {
            return redirect('login'); // Redirect naar de loginpagina als de gebruiker niet is ingelogd
        }

        $user = Auth::user(); // Haal de ingelogde gebruiker op
        // Controleer of de gebruiker een van de opgegeven rollen heeft
        if (!$user->hasAnyRole($roles)) {
            abort(403); // Geef een 403 foutmelding als de gebruiker geen van de opgegeven rollen heeft
        }

        return $next($request); // Ga verder met het verwerken van het verzoek als de gebruiker de juiste rol heeft
    }
}
