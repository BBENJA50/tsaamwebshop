<?php

namespace App\Livewire\roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolesList extends Component
{
    public $all_roles;

    public function mount()
    {
        $this->all_roles = Role::all();
    }

    public function delete($id)
    {
        try {
            Role::where('id', $id)->delete();
            return $this->redirect('/roles', navigate: true);
        } catch (\Exception $th) {
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.roles.roles-list',
            [
                'roles' => Role::paginate(15),
            ]);
    }
}
