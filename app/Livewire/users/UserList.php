<?php

namespace App\Livewire\users;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
    public $all_users;
    public $is_active;

    public function mount()
    {
        $this->all_users = User::withTrashed()->get();
        $this->is_active = 1;
    }

    public function delete($id)
    {
        try {
            //set is_active to 0
            User::where('id', $id)->update(['is_active' => 0]);
            //delete user
            User::where('id', $id)->delete();;

            return $this->redirect('/gebruikers', navigate: true);
        } catch (\Exception $th) {
                dd($th);
            }
    }

    //restore soft deleted users
    public function restore($id)
    {
        try {
            User::where('id', $id)->restore();
            //set is_active to 1
            User::where('id', $id)->update(['is_active' => 1]);
            return $this->redirect('/gebruikers', navigate: true);
        } catch (\Exception $th) {
                dd($th);
            }
    }
    public function render()
    {
        return view('livewire.users.user-list',
            [
                //Toon alle users die ook verwijderd zijn
                'users' => User::withTrashed()->paginate(15),
            ]);
    }
}
