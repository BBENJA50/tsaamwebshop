<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout
{
    /**
     * Log de huidige gebruiker uit de applicatie.
     */
    public function __invoke(): void
    {
        // Log de gebruiker uit door de web guard te gebruiken
        Auth::guard('web')->logout();

        // Invalideer de huidige sessie
        Session::invalidate();
        // Genereer een nieuw sessie token
        Session::regenerateToken();
    }
}
