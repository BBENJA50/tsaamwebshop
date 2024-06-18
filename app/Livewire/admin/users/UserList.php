<?php

namespace App\Livewire\admin\users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UserList extends Component
{
    use WithPagination;

    public $sortField = 'first_name';
    public $sortDirection = 'asc';
    public $search = '';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function delete($id)
    {
        try {
            User::where('id', $id)->update(['is_active' => 0]);
            User::where('id', $id)->delete();

            return $this->redirect('/admin/gebruikers', navigate: true);
        } catch (\Exception $th) {
            dd($th);
        }
    }

    public function restore($id)
    {
        try {
            User::where('id', $id)->restore();
            User::where('id', $id)->update(['is_active' => 1]);
            return $this->redirect('/admin/gebruikers', navigate: true);
        } catch (\Exception $th) {
            dd($th);
        }
    }

    public function render()
    {
        $query = User::withTrashed();

        if ($this->search) {
            $query->where(function($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        $query->orderBy($this->sortField, $this->sortDirection);

        return view('livewire.admin.users.user-list', [
            'roles' => Role::all(),
            'users' => $query->paginate(15),
        ]);
    }
}
