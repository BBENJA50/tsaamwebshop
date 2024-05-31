<?php

namespace App\Livewire\admin\users;

use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public $user_id;
    public User $user;
    public $first_name;
    public $last_name;
    public $email;
    public $gsm_number;

    public function mount( $id )
    {
        $this->user_id = $id;
        $this->user = User::where('id', $id)->first();
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->email = $this->user->email;
        $this->gsm_number = $this->user->gsm_number;
    }

    public function update()
    {
        //validation
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'gsm_number' => 'required',
        ]);
        //edit details
        try {
            User::where('id', $this->user_id)->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'gsm_number' => $this->gsm_number,
                'updated_at' => now()
            ]);
            // redirect
            $this->redirect('/gebruikers', navigate: true);
        } catch (\Exception $th) {
            dd($th);
        }
    }
    public function render()
    {
        return view('livewire.admin.users.edit-user');
    }
}
