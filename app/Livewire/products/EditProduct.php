<?php

namespace App\Livewire\products;

use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subject;
use Livewire\Component;

class EditProduct extends Component
{
    public $product_id;
    public Product $product;
    public $name;
    public $description;
    public $price;
    public $categories;
    public $category_id;
    public $attributen;
    public $attributeOptions;
    public $attribute_id;
    public $selectedAttribute;
    public $subjects;
    public $subject_id;

    public function mount( $id )
    {
        $this->product_id = $id;
        $this->product = Product::where('id', $id)->first();
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
        $this->category_id = $this->product->category_id;
        $this->attribute_id = $this->product->attribute_id;
        $this->selectedAttribute = $this->attribute_id - 1;
        $this->subject_id = $this->product->subject_id;

    }

    public function changeSelectedAttribute($id)
    {
        $this->selectedAttribute = $id - 1;
    }

    public function update()
    {
        //validation
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'attribute_id' => 'required',
            'subject_id' => 'required',
        ]);
        //edit details
        try {
            Product::where('id', $this->product_id)->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'category_id' => $this->category_id,
                'attribute_id' => $this->attribute_id,
                'subject_id' => $this->subject_id,
                'updated_at' => now()
            ]);
            // redirect
            $this->redirect('/producten', navigate: true);
        } catch (\Exception $th) {
            dd($th);
        }
    }
    public function render()
    {
        $this->subjects = Subject::all();
        $this->categories = Category::all();
        $this->attributen = Attribute::all();
        $this->attributeOptions = AttributeOption::all();

        return view('livewire.products.edit-product');
    }
}
