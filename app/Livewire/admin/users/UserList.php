<?php

namespace App\Livewire\admin\users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UserList extends Component
{
    use WithPagination; // Gebruik paginering in dit component

    public $sortField = 'first_name'; // Veld waarop gesorteerd moet worden
    public $sortDirection = 'asc'; // Richting van de sortering
    public $search = ''; // Zoekterm

    // Methode om op een specifiek veld te sorteren
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    // Methode om een gebruiker te verwijderen
    public function delete($id)
    {
        try {
            User::where('id', $id)->update(['is_active' => 0]); // Zet de gebruiker inactief
            User::where('id', $id)->delete(); // Verwijder de gebruiker

            return $this->redirect('/admin/gebruikers', navigate: true); // Redirect naar de gebruikerspagina
        } catch (\Exception $th) {
            dd($th); // Toon de uitzondering als er een fout optreedt
        }
    }

    // Methode om een gebruiker te herstellen
    public function restore($id)
    {
        try {
            User::where('id', $id)->restore(); // Herstel de gebruiker
            User::where('id', $id)->update(['is_active' => 1]); // Zet de gebruiker actief
            return $this->redirect('/admin/gebruikers', navigate: true); // Redirect naar de gebruikerspagina
        } catch (\Exception $th) {
            dd($th); // Toon de uitzondering als er een fout optreedt
        }
    }

    // Methode om de component te renderen
    public function render()
    {
        $query = User::withTrashed(); // Haal alle gebruikers op, inclusief de verwijderde

        // Zoekfunctie
        if ($this->search) {
            $query->where(function($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        // Sorteer de resultaten
        $query->orderBy($this->sortField, $this->sortDirection);

        // Retourneer de weergave met de gebruikers en rollen
        return view('livewire.admin.users.user-list', [
            'roles' => Role::all(),
            'users' => $query->paginate(15),
        ]);
    }
}
