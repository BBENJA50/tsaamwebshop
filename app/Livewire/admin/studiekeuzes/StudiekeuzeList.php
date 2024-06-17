<?php


namespace App\Livewire\admin\studiekeuzes;

use App\Models\Product;
use App\Models\Studiekeuze;
use Livewire\Component;
use Livewire\WithPagination;

class StudiekeuzeList extends Component
{
    use WithPagination;

    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $search = '';

    public function mount()
    {
        $this->all_studiekeuzes = Studiekeuze::all();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }


    public function delete($id)
    {
        try {
            Studiekeuze::where('id', $id)->delete();
            return $this->redirect('/studiekeuzes', navigate: true);
        } catch (\Exception $th) {
            dd($th);
        }
    }

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
