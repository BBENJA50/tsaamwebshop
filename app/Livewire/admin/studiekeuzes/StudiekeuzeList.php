<?php

namespace App\Livewire\admin\studiekeuzes;

use App\Models\Product;
use App\Models\Studiekeuze;
use Livewire\Component;

class StudiekeuzeList extends Component
{
    public $all_studiekeuzes;
    public $all_products;


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
        return view('livewire.admin.studiekeuzes.studiekeuze-list',
            [
                'products' => Product::all(),
                'studiekeuzes' => Studiekeuze::paginate(15),
            ]);
    }
}
