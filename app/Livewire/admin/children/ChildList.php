<?php

namespace App\Livewire\admin\children;

use App\Models\Child;
use Livewire\Component;
use Livewire\WithPagination;

class ChildList extends Component
{
    use WithPagination; // Gebruik paginering

    public $sortField = 'first_name'; // Standaard sorteerveld
    public $sortDirection = 'asc'; // Standaard sorteerrichting
    public $search = ''; // Zoekterm

    /**
     * Sorteerfunctie voor het wisselen van sorteervelden en -richtingen.
     *
     * @param string $field
     */
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'; // Wissel sorteerrichting
        } else {
            $this->sortField = $field; // Stel nieuw sorteerveld in
            $this->sortDirection = 'asc'; // Standaard sorteerrichting
        }
    }

    /**
     * Functie die wordt aangeroepen bij het bijwerken van de zoekterm.
     */
    public function updatingSearch()
    {
        $this->resetPage(); // Reset de paginering bij het bijwerken van de zoekterm
    }

    /**
     * Functie om een kind te verwijderen.
     *
     * @param int $id
     */
    public function delete($id)
    {
        try {
            Child::where('id', $id)->update(['is_active' => 0]); // Zet de status op inactief
            Child::where('id', $id)->delete(); // Verwijder het kind

            return $this->redirect('/admin/kinderen', navigate: true); // Redirect naar de kinderen-pagina
        } catch (\Exception $th) {
            dd($th); // Toon fout voor debugging
        }
    }

    /**
     * Functie om een kind te herstellen.
     *
     * @param int $id
     */
    public function restore($id)
    {
        try {
            Child::where('id', $id)->restore(); // Herstel het kind
            Child::where('id', $id)->update(['is_active' => 1]); // Zet de status op actief
            return $this->redirect('/admin/kinderen', navigate: true); // Redirect naar de kinderen-pagina
        } catch (\Exception $th) {
            dd($th); // Toon fout voor debugging
        }
    }

    /**
     * Render de Livewire component view.
     */
    public function render()
    {
        $query = Child::withTrashed(); // Haal alle kinderen op, inclusief verwijderde

        if ($this->search) {
            $query->where(function($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%'); // Zoek op voornaam of achternaam
            });
        }

        $query->orderBy($this->sortField, $this->sortDirection); // Pas sortering toe

        return view('livewire.admin.children.child-list', [
            'children' => $query->paginate(15), // Pagina met 15 kinderen
        ]);
    }
}
