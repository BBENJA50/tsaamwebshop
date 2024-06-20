<?php

namespace App\Livewire\admin\users;

use App\Models\User;
use Livewire\Component;

class AddUser extends Component
{
    // Declareer de variabelen die gebruikt zullen worden in dit component
    public $first_name;
    public $last_name;
    public $email;
    public $gsm_number;
    public $password;
    public $confirm_password;

    // Methode om een gebruiker op te slaan
    public function saveUser()
    {
        // Valideer de invoerwaarden
        $this->validate([
            'first_name' => 'required', // Voornaam is verplicht
            'last_name' => 'required', // Achternaam is verplicht
            'email' => 'required', // E-mail is verplicht
            'gsm_number' => 'required', // GSM-nummer is verplicht
            'password' => 'required|min:6', // Wachtwoord is verplicht en moet minstens 6 tekens lang zijn
            'confirm_password' => 'required|same:password', // Bevestig wachtwoord is verplicht en moet gelijk zijn aan wachtwoord
        ]);

        try {
            // Controleer of het wachtwoord hetzelfde is als het bevestigde wachtwoord
            if ($this->password == $this->confirm_password) {
                // Maak een nieuwe gebruiker aan met de ingevoerde gegevens
                User::create([
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'email' => $this->email,
                    'gsm_number' => $this->gsm_number,
                    'password' => bcrypt($this->password), // Versleutel het wachtwoord
                ]);

                // Redirect naar de gebruikerspagina na succesvolle creatie
                return $this->redirect('/admin/gebruikers', navigate: true);
            } else {
                // Voeg een foutmelding toe als de wachtwoorden niet overeenkomen
                return response()->json([
                    'message' => 'Record not found.'
                ], 404);
            }

        } catch (\Exception $e) {
            // Als er een uitzondering optreedt, toon deze
            dd($e);
        }
    }

    // Render de Livewire-component
    public function render()
    {
        return view('livewire.admin.users.add-user');
    }
}
