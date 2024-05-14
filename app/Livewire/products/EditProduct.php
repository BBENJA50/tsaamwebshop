<?php

namespace App\Livewire\products;

use App\Models\Category;
use App\Models\Product;
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

    public function mount( $id )
    {
        $this->product_id = $id;
        $this->product = Product::where('id', $id)->first();
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
        $this->category_id = $this->product->category_id;
    }

    public function update()
    {
        //validation
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);
        //edit details
        try {
            Product::where('id', $this->product_id)->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'category_id' => $this->category_id,
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
        $this->categories = Category::all();

        return view('livewire.products.edit-product');
    }
}
