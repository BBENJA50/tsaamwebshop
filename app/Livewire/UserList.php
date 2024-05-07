<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    public function render()
    {
        return view('livewire.users.user-list',
            [
                'users' => User::paginate(15),
            ]);
    }
}
