<?php

namespace App\Livewire\categories;

use App\Models\Category;
use Livewire\Component;

class EditCategory extends Component
{

    public function editCategory($id){


    }

    public function updateCategory()
    {
        $category = Category::find(request('id'));
        $request = request();

        $category->update([
            'name' => $request->input('name'),
        ]);
    }

    public function render()
    {
        return view('livewire.categories.edit-category', ['category' => Category::find(request('id'))]);
    }
}
