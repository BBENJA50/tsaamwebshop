<?php

namespace App\Livewire\categories;

use App\Models\Category;
use Livewire\Component;

class AddCategory extends Component
{
    public $name;

    public function saveCategory()
    {
        $this->validate([
            'name' => 'required',
        ]);

        try {

            Category::create([
                'name' => $this->name,
            ]);

            return $this->redirect('/categorie', navigate: true);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function deleteCategory($id){
        $category = Category::find($id);
        $category->delete();
        return $this->redirect('/categorie', navigate: true);
    }


    public function render()
    {
        return view('livewire.categories.add-category');
    }
}
