<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class EditCategory extends Component
{

    public function editCategory($id){

        $category = Category::findOrFail($id);
        $this->name = $category->name;


    }

    public function updateCategory()
    {
        $this->validate([
            'name' => 'required',
        ]);

        $category = Category::find(request('id'));
        $category->update([

            'name' => $this->name,

        ]);

        return $this->redirect('/categorie', navigate: true);
    }

    public function render()
    {
        return view('livewire.categories.edit-category', ['category' => Category::find(request('id'))]);
    }
}
