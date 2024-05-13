<?php

namespace App\Livewire\products;

use App\Models\Product;
use Livewire\Component;

class EditProduct extends Component
{
    public $product_id;

    public Product $product;
    public $name;
    public $description;
    public $price;

    public function mount( $id )
    {
        $this->product_id = $id;
        $this->product = Product::where('id', $id)->first();
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
    }

    public function update()
    {
        //validation
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        //edit details
        try {
            Product::where('id', $this->product_id)->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
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
        return view('livewire.products.edit-product');
    }
}
