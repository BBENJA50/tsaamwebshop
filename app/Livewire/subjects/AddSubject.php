<?php

namespace App\Livewire\subjects;

use App\Models\Subject;
use Livewire\Component;

class AddSubject extends Component
{
    public $name;

    public function saveSubject()
    {
        $this->validate([
            'name' => 'required',
        ]);

        try {
            Subject::create([
                'name' => $this->name,
            ]);
            return $this->redirect('/vakken', navigate: true);
        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function render()
    {
        return view('livewire.subjects.add-subject');
    }
}
