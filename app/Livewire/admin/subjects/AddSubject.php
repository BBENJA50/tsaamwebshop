<?php

namespace App\Livewire\admin\subjects;

use App\Models\Subject;
use Livewire\Component;

class AddSubject extends Component
{
    public $name; // Naam van het vak

    // Functie om een nieuw vak op te slaan
    public function saveSubject()
    {
        // Validatie om te controleren of de naam is ingevuld
        $this->validate([
            'name' => 'required',
        ]);

        try {
            // Aanmaken van een nieuw vak met de opgegeven naam
            Subject::create([
                'name' => $this->name,
            ]);
            // Redirect naar de vakken pagina
            return $this->redirect('/admin/vakken', navigate: true);
        } catch (\Exception $e) {
            // Foutafhandeling
            dd($e);
        }
    }

    // Render-functie om de component weer te geven
    public function render()
    {
        return view('livewire.admin.subjects.add-subject');
    }
}
