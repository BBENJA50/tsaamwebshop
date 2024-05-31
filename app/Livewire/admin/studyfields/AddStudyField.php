<?php

namespace App\Livewire\admin\studyfields;

use App\Models\StudyField;
use Livewire\Component;

class AddStudyField extends Component
{
    public $name;

    public function saveStudyField()
    {
        $this->validate([
            'name' => 'required',
        ]);

        try {
            StudyField::create([
                'name' => $this->name,
            ]);
            return $this->redirect('/richtingen', navigate: true);
        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function render()
    {
        return view('livewire.admin.studyfields.add-studyfield');
    }
}
