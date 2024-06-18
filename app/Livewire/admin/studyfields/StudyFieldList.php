<?php

namespace App\Livewire\admin\studyfields;

use App\Models\StudyField;
use Livewire\Component;
use Livewire\WithPagination;

class StudyFieldList extends Component
{
    use WithPagination;

    public $sortDirection = 'asc'; // Sorteerrichting, standaard oplopend
    public $search = ''; // Zoekterm

    // Mount-functie, hoeft hier niets in te zetten
    public function mount()
    {
        // Geen actie nodig tijdens mount
    }

    // Functie om een studieveld te verwijderen
    public function delete($id)
    {
        try {
            StudyField::where('id', $id)->delete();
            // Redirect naar de richtingen pagina
            return $this->redirect('/admin/richtingen', navigate: true);
        } catch (\Exception $th) {
            dd($th);
        }
    }

    // Functie om de sorteerrichting op naam te wijzigen
    public function sortByName()
    {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    // Functie om de zoekopdracht bij te werken
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Render-functie om de component weer te geven
    public function render()
    {
        $studyfields = StudyField::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy('name', $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.studyfields.studyfield-list', [
            'studyfields' => $studyfields,
        ]);
    }
}
