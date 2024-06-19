<?php

namespace App\Livewire\admin\studiekeuzes;

use App\Models\Product;
use App\Models\Studiekeuze;
use Livewire\Component;
use Livewire\WithPagination;

class StudiekeuzeList extends Component
{
    use WithPagination;

    public $sortField = 'name'; // Veld om op te sorteren
    public $sortDirection = 'asc'; // Sorteervolgorde (asc of desc)
    public $search = ''; // Zoekterm

    // Initialisatie van de component
    public function mount()
    {
        $this->all_studiekeuzes = Studiekeuze::all(); // Haal alle studiekeuzes op
    }

    // Sorteer de studiekeuzes op het opgegeven veld
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    // Verwijder een studiekeuze
    public function delete($id)
    {
        try {
            Studiekeuze::where('id', $id)->delete();
            return $this->redirect('/admin/studiekeuzes', navigate: true);
        } catch (\Exception $th) {
            dd($th);
        }
    }

    // Render de Livewire component view
    public function render()
    {
        $studiekeuzes = Studiekeuze::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(15);

        return view('livewire.admin.studiekeuzes.studiekeuze-list', [
            'products' => Product::all(),
            'studiekeuzes' => $studiekeuzes,
        ]);
    }
}
