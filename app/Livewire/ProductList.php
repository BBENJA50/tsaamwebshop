<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

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
