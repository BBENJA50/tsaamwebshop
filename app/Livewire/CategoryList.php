<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryList extends Component
{
    public function render()
    {
        return view('livewire.categories.category-list',
            [
                'categories' => Category::paginate(15),
            ]);
    }
}
