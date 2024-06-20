<?php

namespace App\Livewire\admin\users;

use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    // Declaratie van variabelen die gebruikt zullen worden in dit component
    public $user_id;
    public User $user;
    public $first_name;
    public $last_name;
    public $email;
    public $gsm_number;

    // Mount methode die wordt uitgevoerd bij het initialiseren van het component
    public function mount($id)
    {
        $this->user_id = $id; // Zet de gebruiker ID
        $this->user = User::where('id', $id)->first(); // Haal de gebruiker op uit de database
        $this->first_name = $this->user->first_name; // Zet de voornaam van de gebruiker
        $this->last_name = $this->user->last_name; // Zet de achternaam van de gebruiker
        $this->email = $this->user->email; // Zet de e-mail van de gebruiker
        $this->gsm_number = $this->user->gsm_number; // Zet het gsm-nummer van de gebruiker
    }

    // Methode om de gebruiker bij te werken
    public function update()
    {
        // Validatie van de invoerwaarden
        $this->validate([
            'first_name' => 'required', // Voornaam is verplicht
            'last_name' => 'required', // Achternaam is verplicht
            'email' => 'required', // E-mail is verplicht
            'gsm_number' => 'required', // GSM-nummer is verplicht
        ]);

        // Bewerken van de gebruikersgegevens
        try {
            User::where('id', $this->user_id)->update([
                'first_name' => $this->first_name, // Update voornaam
                'last_name' => $this->last_name, // Update achternaam
                'email' => $this->email, // Update e-mail
                'gsm_number' => $this->gsm_number, // Update gsm-nummer
                'updated_at' => now() // Zet de update tijd op nu
            ]);

            // Redirect naar de gebruikerspagina na succesvolle update
            $this->redirect('/admin/gebruikers', navigate: true);
        } catch (\Exception $th) {
            // Toon de uitzondering als er een fout optreedt
            dd($th);
        }
    }

    // Render de Livewire-component
    public function render()
    {
        return view('livewire.admin.users.edit-user');
    }
}
