<?php

namespace App\Livewire\categories;

use App\Models\Category;
use Livewire\Component;

class CategoryList extends Component
{
    public $all_categories;

    public function mount()
    {
        $this->all_categories = Category::all(); // get all categories
    }

    public function delete($id)
    {
        try {
            Category::where('id', $id)->delete();
            return $this->redirect('/categorie', navigate: true);
        } catch (\Exception $th) {
            dd($th);
        }
    }
    public function render()
    {
        return view('livewire.categories.category-list',
            [
                'categories' => Category::paginate(15),
            ]);
    }
}
