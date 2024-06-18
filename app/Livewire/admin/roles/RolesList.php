<?php

namespace App\Livewire\admin\roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolesList extends Component
{
    public $all_roles; // Variabele voor alle rollen

    /**
     * Initialiseer de component met alle rollen.
     */
    public function mount()
    {
        $this->all_roles = Role::all(); // Haal alle rollen op
    }

    /**
     * Verwijder een rol op basis van het ID.
     *
     * @param int $id
     */
    public function delete($id)
    {
        try {
            Role::where('id', $id)->delete(); // Verwijder de rol
            return $this->redirect('/roles', navigate: true); // Redirect naar de rollen pagina
        } catch (\Exception $th) {
            dd($th); // Toon de foutmelding
        }
    }

    /**
     * Render de Livewire component view.
     */
    public function render()
    {
        return view('livewire.admin.roles.roles-list', [
            'roles' => Role::paginate(15), // Pagineer de rollen
        ]);
    }
}
