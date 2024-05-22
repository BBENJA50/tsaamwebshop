<?php

namespace App\Livewire\children;

use App\Models\Child;
use App\Models\Studiekeuze;
use App\Models\User;
use Livewire\Component;

class EditChild extends Component
{
    public $child_id;
    public $first_name;
    public $last_name;
    public Child $child;
    public $users;
    public $user_id;
    public $studiekeuzes;
    public $studiekeuze_id;

    public function mount( $id )
    {
        $this->child_id = $id;
        $this->child = Child::where('id', $id)->first();
        $this->first_name = $this->child->first_name;
        $this->last_name = $this->child->last_name;
        if ($this->child->user) {
            $this->user_id = $this->child->user->first_name . ' ' . $this->child->user->last_name;
        } else {
            $this->user_id = ' ';
        }
        if ($this->child->studiekeuze) {
            $this->studiekeuze_id = $this->child->studiekeuze->id;
        } else {
            $this->studiekeuze_id = ' ';
        }
    }

    public function update()
    {
        //validation
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'user_id' => 'required',
            'studiekeuze_id' => 'required',
        ]);
        //edit details
        try {
            Child::where('id', $this->child_id)->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'user_id' => $this->child->user->id,
                'studiekeuze_id' => $this->studiekeuze_id,
                'updated_at' => now()
            ]);
            // redirect
            // if page is edit/gebruiker, go back to the users page else go back to the children page
            if (strpos($_SERVER['HTTP_REFERER'], 'edit/gebruiker') !== false) {
                $this->redirect('/gebruikers', navigate: true);
            } else {
                $this->redirect('/kinderen', navigate: true);
            }
        } catch (\Exception $th) {
            dd($th);
        }
    }
    public function render()
    {
        $this->studiekeuzes = Studiekeuze::all();
        return view('livewire.children.edit-child');
    }
}
