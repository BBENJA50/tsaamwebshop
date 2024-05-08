<?php

namespace App\Livewire\users;

use App\Models\User;
use Livewire\Component;

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
