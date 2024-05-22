<?php

namespace App\Livewire\children;

use App\Models\Child;
use App\Models\Studiekeuze;
use App\Models\User;
use Livewire\Component;

class AddChild extends Component
{
    public $first_name;
    public $last_name;
    public $user_id;
    public $users;
    public $studiekeuzes;
    public $studiekeuze_id;

    public function saveChild()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'user_id' => 'required',
            'studiekeuze_id' => 'required',
        ]);
        try {
            Child::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'user_id' => $this->user_id,
                'studiekeuze_id' => $this->studiekeuze_id,
            ]);
            return $this->redirect('/kinderen', navigate: true);
        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function render()
    {
        $this->users = User::all();
        $this->studiekeuzes = Studiekeuze::all();
        return view('livewire.children.add-child');
    }
}
