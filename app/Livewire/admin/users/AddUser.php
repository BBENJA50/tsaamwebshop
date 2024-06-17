<?php

namespace App\Livewire\admin\users;

use App\Models\User;
use Livewire\Component;

class AddUser extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $gsm_number;
    public $password;
    public $confirm_password;

    public function saveUser()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'gsm_number' => 'required',
            'password' => 'required|min:6',
            //confirm_password must be same as password
            'confirm_password' => 'required|same:password',
        ]);

        try {
            //check if password is the same as confirm password
            if ($this->password == $this->confirm_password) {
                User::create([
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'email' => $this->email,
                    'gsm_number' => $this->gsm_number,
                    'password' => bcrypt($this->password),
                ]);

                return $this->redirect('/admin/gebruikers', navigate: true);
            } else {
                //add error message
                return response()->json([
                    'message' => 'Record not found.'
                ], 404);}

        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.admin.users.add-user');
    }
}
