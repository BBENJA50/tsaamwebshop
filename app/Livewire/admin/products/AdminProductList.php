<?php

namespace App\Livewire\admin\products;

use App\Models\Category;
use App\Models\Product;
use App\Models\Studiekeuze;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductList extends Component
{
    use WithPagination;

    public $child;
    public $category_id;

    public function delete($id)
    {
        try {
            Product::where('id', $id)->delete();
            return redirect('/producten');
        } catch (Exception $th) {
            dd($th);
        }
    }

    public function render()
    {
        try {
            $query = Product::query();

            if (auth()->user()->hasRole('admin')) {

                $products = $query->paginate('15');

                $categories = Category::whereHas('products')->get();

                return view('livewire.admin.products.product-list', [
                    'studiekeuzes' => Studiekeuze::all(),
                    'products' => $products,
                    'categories' => $categories,
                ]);
            }
        } catch (Exception $e) {
            logger()->error('Error in ProductList component: ' . $e->getMessage());
            session()->flash('error', 'Er is een fout opgetreden. Probeer het opnieuw.');
            return redirect('/producten');
        }
    }
}
