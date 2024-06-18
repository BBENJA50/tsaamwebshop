<?php

namespace App\Livewire\admin\children;

use App\Models\Child;
use App\Models\Studiekeuze;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddChild extends Component
{
    public $first_name; // Variabele voor de voornaam van het kind
    public $last_name; // Variabele voor de achternaam van het kind
    public $studiekeuzes; // Variabele om de studiekeuzes op te slaan
    public $users; // Variabele om de gebruikers op te slaan
    public $studiekeuze_id; // Variabele om het studiekeuze ID op te slaan

    /**
     * Functie om een nieuw kind op te slaan in de database.
     */
    public function saveChild()
    {
        // Validatie van de invoer
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'studiekeuze_id' => 'required',
        ]);

        // Probeer het kind op te slaan
        try {
            Child::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'user_id' => Auth::id(), // Stel het user_id in op de ID van de ingelogde gebruiker
                'studiekeuze_id' => $this->studiekeuze_id,
            ]);

            // Sla een succesbericht op in de sessie
            session()->flash('message', 'Kind succesvol toegevoegd.');

            // Als de gebruiker een admin is, redirect naar de admin kinderen pagina
            if (Auth::user()->hasRole('admin')) {
                return $this->redirect('/admin/kinderen', navigate: true);
            } else {
                // Anders, redirect naar de home pagina
                return $this->redirect('/home', navigate: true);
            }

        } catch (\Exception $e) {
            // Vang eventuele fouten op en dump deze voor debugging
            dd($e);
        }
    }

    /**
     * Render de Livewire component view.
     */
    public function render()
    {
        $this->users = User::all(); // Haal alle gebruikers op
        $this->studiekeuzes = Studiekeuze::orderBy('name', 'asc')->get(); // Haal alle studiekeuzes op, gesorteerd op naam
        return view('livewire.admin.children.add-child');
    }
}
