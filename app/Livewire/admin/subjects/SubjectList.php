<?php

namespace App\Livewire\admin\subjects;

use App\Models\Subject;
use Livewire\Component;

class SubjectList extends Component
{
    public $subjects; // Variabele om de lijst van vakken op te slaan

    // Functie die wordt uitgevoerd bij het laden van de component
    public function mount()
    {
        // Ophalen van alle vakken uit de database
        $this->subjects = Subject::all();
    }

    // Functie om een vak te verwijderen
    public function delete($id)
    {
        try {
            // Verwijderen van het vak met het opgegeven ID
            Subject::where('id', $id)->delete();
            // Redirect naar de vakken pagina
            return $this->redirect('/admin/vakken', navigate: true);
        } catch (\Exception $th) {
            // Foutafhandeling
            dd($th);
        }
    }

    // Render-functie om de component weer te geven
    public function render()
    {
        return view('livewire.admin.subjects.subject-list', [
            'subjects' => Subject::paginate(10), // Pagineren van de vakkenlijst
        ]);
    }
}
