<?php

namespace App\Livewire\admin\studyfields;

use App\Models\StudyField;
use Livewire\Component;

class StudyFieldList extends Component
{
    public $studyfields;

    public function mount()
    {
        $this->studyfields = StudyField::all();
    }

    public function delete($id)
    {
        try {
            StudyField::where('id', $id)->delete();
            return $this->redirect('/studyfields', navigate: true);
        } catch (\Exception $th) {
            dd($th);
        }
    }
    public function render()
    {
        return view('livewire.admin.studyfields.studyfield-list',
            [
                'studyfields' => StudyField::paginate(10),
            ]);
    }
}
