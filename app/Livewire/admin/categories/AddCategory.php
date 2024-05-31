<?php

namespace App\Livewire\admin\categories;

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

    public function render()
    {
        return view('livewire.admin.categories.add-category');
    }
}
