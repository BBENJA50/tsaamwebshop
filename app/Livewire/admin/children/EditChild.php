<?php

namespace App\Livewire\admin\children;

use App\Models\Child;
use App\Models\Studiekeuze;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditChild extends Component
{
    public $child_id; // ID van het kind
    public $first_name; // Voornaam van het kind
    public $last_name; // Achternaam van het kind
    public Child $child; // Kind model
    public $users; // Gebruikers
    public $user_id; // ID van de gebruiker
    public $studiekeuzes; // Studiekeuzes
    public $studiekeuze_id; // ID van de studiekeuze

    /**
     * Mount de component met de ID van het kind.
     *
     * @param int $id
     */
    public function mount($id)
    {
        $this->child_id = $id;
        $this->child = Child::where('id', $id)->first();
        $this->first_name = $this->child->first_name;
        $this->last_name = $this->child->last_name;
        if ($this->child->user) {
            $this->user_id = $this->child->user->first_name . ' ' . $this->child->user->last_name;
        } else {
            $this->user_id = ' ';
        }
        if ($this->child->studiekeuze) {
            $this->studiekeuze_id = $this->child->studiekeuze->id;
        } else {
            $this->studiekeuze_id = ' ';
        }
    }

    /**
     * Update de gegevens van het kind.
     */
    public function update()
    {
        // Validatie
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'user_id' => 'required',
            'studiekeuze_id' => 'required',
        ]);

        // Bewerk de gegevens
        try {
            Child::where('id', $this->child_id)->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'user_id' => $this->child->user->id,
                'studiekeuze_id' => $this->studiekeuze_id,
                'updated_at' => now()
            ]);

            // Redirect
            // Als de pagina 'edit/gebruiker' is, ga terug naar de gebruikerspagina, anders naar de kinderenpagina
            if (strpos($_SERVER['HTTP_REFERER'], 'edit/gebruiker') !== false) {
                $this->redirect('/admin/gebruikers', navigate: true);
            } else {
                // Als gebruiker admin is
                if (Auth::user()->hasRole('admin')) {
                    $this->redirect('/admin/kinderen', navigate: true);
                } else{
                    $this->redirect('/home', navigate: true);
                }
            }
        } catch (\Exception $th) {
            dd($th); // Toon fout voor debugging
        }
    }

    /**
     * Verwijder de gebruiker van het kind.
     *
     * @param int $id
     */
    public function removeUser($id)
    {
        try {
            Child::where('id', $this->child_id)->update([
                'user_id' => null
            ]);

            // Redirect
            if (Auth::user()->hasRole('admin')) {
                // Als de huidige pagina 'edit/gebruiker' is, ga terug naar de gebruikerspagina, anders naar de kinderenpagina
                if (strpos($_SERVER['HTTP_REFERER'], 'edit/gebruiker') !== false) {
                    $this->redirect('/admin/gebruikers', navigate: true);
                } else {
                    $this->redirect('/admin/kinderen', navigate: true);
                }
            } else{
                $this->redirect('/home', navigate: true);
            }
        } catch (\Exception $th) {
            dd($th); // Toon fout voor debugging
        }
    }

    /**
     * Render de Livewire component view.
     */
    public function render()
    {
        $this->studiekeuzes = Studiekeuze::all();
        return view('livewire.admin.children.edit-child');
    }
}
