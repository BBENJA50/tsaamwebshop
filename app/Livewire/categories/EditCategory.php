<?php

namespace App\Livewire\categories;

use App\Models\Category;
use Livewire\Component;

class EditCategory extends Component
{
    public $category_id;

    public Category $category;
    public $name;


    public function mount( $id )
    {
        $this->category_id = $id;
        $this->category = Category::where('id', $id)->first();
        $this->name = $this->category->name;
    }

    public function update()
    {
        //validation
        $this->validate([
            'name' => 'required',
        ]);
        //edit details
        try {
            Category::where('id', $this->category_id)->update([
                'name' => $this->name
            ]);
            // redirect
            $this->redirect('/categorie', navigate: true);
        } catch (\Exception $th) {
            dd($th);
        }
    }


    public function render()
    {
        return view('livewire.categories.edit-category', ['category' => Category::find(request('id'))]);
    }
}
