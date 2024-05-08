<?php

namespace App\Livewire\products;

use App\Models\Product;
use Livewire\Component;

class AddProduct extends Component
{
    public $name;
    public $price;
    public $description;
    public $maten;
    public $categories;
    public $kleur;

    public function saveProduct()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
//            'maten' => 'required',
//            'categories' => 'required',
//            'kleur' => 'required',
        ]);

        try {

            Product::create([
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
//                'maten' => $this->maten,
//                'categories' => $this->categories,
//                'kleur' => $this->kleur,

            ]);

            return $this->redirect('/producten', navigate: true);

        } catch (\Exception $e) {
            dd($e);
        }

    }
    public function render()
    {
        return view('livewire.products.add-product');
    }
}
