<?php

namespace App\Livewire\products;

use App\Models\AttributeOption;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Subject;
use Livewire\Component;

class AddProduct extends Component
{
    public $name;
    public $price;
    public $description;
    public $categories;
    public $category_id;
    public $attributen;
    public $attributeOptions;
    public $attribute_id;
    public $selectedAttribute = 0;
    public $subjects;
    public $subject_id;

    public function changeSelectedAttribute($id)
    {
        $this->selectedAttribute = $id - 1;
    }

    public function saveProduct()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'attribute_id' => 'required',
            'subject_id' => 'required',
        ]);

        try {
            Product::create([
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
                'category_id' => $this->category_id,
                'attribute_id' => $this->attribute_id,
                'subject_id' => $this->subject_id
            ]);

            return $this->redirect('/producten', navigate: true);

        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function render()
    {
        $this->subjects = Subject::all();
        $this->categories = Category::all();
        $this->attributen = Attribute::all();
        $this->attributeOptions = AttributeOption::all();


        return view('livewire.products.add-product');
    }
}
