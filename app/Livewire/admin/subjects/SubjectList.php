<?php

namespace App\Livewire\admin\subjects;

use App\Models\Subject;
use Livewire\Component;

class SubjectList extends Component
{
    public $subjects;

    public function mount()
    {
        $this->subjects = Subject::all();
    }

    public function delete($id)
    {
        try {
            Subject::where('id', $id)->delete();
            return $this->redirect('/vakken', navigate: true);
        } catch (\Exception $th) {
            dd($th);
        }
    }
    public function render()
    {
        return view('livewire.admin.subjects.subject-list',
            [
                'subjects' => Subject::paginate(10),
            ]);
    }
}
