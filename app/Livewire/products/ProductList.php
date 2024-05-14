<?php

namespace App\Livewire\products;


use App\Models\Product;
use Livewire\Component;

class ProductList extends Component
{
    public $all_products;

    public function mount()
    {
        $this->all_products = Product::all();
    }

    public function delete($id)
    {
        try {
            Product::where('id', $id)->delete();
            return $this->redirect('/producten', navigate: true);
        } catch (\Exception $th) {
            dd($th);
        }
    }
    public function render()
    {
        return view('livewire.products.product-list',
            [
                'products' => Product::paginate(15),
            ]);
    }
}
