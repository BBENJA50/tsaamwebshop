<?php

namespace App\Livewire\admin\children;

use App\Models\Child;
use App\Models\Studiekeuze;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddChild extends Component
{
    public $first_name;
    public $last_name;
    public $studiekeuzes;
    public $users;
    public $studiekeuze_id;

    public function saveChild()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'studiekeuze_id' => 'required',
        ]);

        try {
            Child::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'user_id' => Auth::id(), // Set the user_id to the authenticated user's ID
                'studiekeuze_id' => $this->studiekeuze_id,
            ]);

            session()->flash('message', 'Child added successfully.');
//            if user is admin
            if (Auth::user()->hasRole('admin')) {
                return $this->redirect('/admin/kinderen', navigate: true);
            } else{
                return $this->redirect('/home', navigate: true);
            }

        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        $this->users = User::all();
        $this->studiekeuzes = Studiekeuze::orderBy('name', 'asc')->get();
        return view('livewire.admin.children.add-child');
    }
}
