<?php

namespace App\Livewire\admin\studyfields;

use App\Models\StudyField;
use Livewire\Component;
use Livewire\WithPagination;

class StudyFieldList extends Component
{
    use WithPagination;

    public $sortDirection = 'asc';
    public $search = '';

    public function mount()
    {
        // No need to set anything here
    }

    public function sortByName()
    {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

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
