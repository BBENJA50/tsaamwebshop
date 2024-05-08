<?php

namespace App\Livewire\products;

use App\Models\Product;
use Livewire\Component;

class ProductList extends Component
{
    public function render()
    {
        return view('livewire.products.product-list',
            [
                'products' => Product::paginate(15),
            ]);
    }
}
