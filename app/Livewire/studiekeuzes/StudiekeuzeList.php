<?php

namespace App\Livewire\studiekeuzes;

use App\Models\Studiekeuze;
use Livewire\Component;

class StudiekeuzeList extends Component
{
    public $all_studiekeuzes;


    public function mount()
    {
        $this->all_studiekeuzes = Studiekeuze::all();

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
        return view('livewire.studiekeuzes.studiekeuze-list',
            [
                'studiekeuzes' => Studiekeuze::paginate(15),
            ]);
    }
}
