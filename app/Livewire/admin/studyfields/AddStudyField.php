<?php

namespace App\Livewire\admin\studyfields;

use App\Models\StudyField;
use Livewire\Component;

class AddStudyField extends Component
{
    public $name; // Naam van het studieveld

    // Methode om een studieveld op te slaan
    public function saveStudyField()
    {
        // Valideer de invoer
        $this->validate([
            'name' => 'required',
        ]);

        try {
            // Maak een nieuw studieveld aan
            StudyField::create([
                'name' => $this->name,
            ]);
            // Redirect naar de richtingen pagina
            return $this->redirect('/admin/richtingen', navigate: true);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    // Render de Livewire component view
    public function render()
    {
        return view('livewire.admin.studyfields.add-studyfield');
    }
}
