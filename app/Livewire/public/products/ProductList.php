<?php

namespace App\Livewire\public\products;

use App\Models\Category;
use App\Models\Product;
use App\Models\Studiekeuze;
use Exception;
use http\Env\Request;
use Livewire\Component;

class ProductList extends Component
{
    public $child;
    public $category_id;

    public function mount($childId = null)
    {
        if ($childId) {
            $this->child = auth()->user()->children()->find($childId);

            if (!$this->child) {
                session()->flash('error', 'Geen kind gevonden');
                return redirect('/producten');
            }
        }
    }

    public function filterByCategory($category_id)
    {
        $this->category_id = $category_id;
    }

    public function addToCart( $id)
    {
        $productId = $id;
        $product = Product::find($productId);

        if (!$product) {
            return;
        }

        $cart = session()->get('cart', []);

        $cart[$productId] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'image' => $product->image,
        ];

        session()->put('cart', $cart);
        dd( $cart);
    }

    public function render()
    {
        try {
            $query = Product::query();

            if ($this->child) {
                $query->whereHas('studiekeuzes', function ($query) {
                    $query->where('studiekeuzes.id', $this->child->studiekeuze->id);
                });

                if ($this->category_id) {
                    $query->where('category_id', $this->category_id);
                }

                $products = $query->get();
            } else {
                $products = collect();
            }

            // Toont enkel de categorien die aan de producten voldoen
            $categories = Category::whereHas('products', function ($query) {
                if ($this->child) {
                    $query->whereHas('studiekeuzes', function ($query) {
                        $query->where('studiekeuzes.id', $this->child->studiekeuze->id);
                    });
                }
            })->get();

            return view('livewire.public.products.product-list', [
                'studiekeuzes' => Studiekeuze::all(),
                'products' => $products,
                'categories' => $categories,
                'child' => $this->child ?? collect([
                        'id' => null,
                        'name' => 'Onbekend',
                    ]),
                'category_id' => $this->category_id, // Pass the current category_id to the view
            ]);
        } catch (Exception $e) {
            logger()->error('Error in ProductList component: ' . $e->getMessage());
            session()->flash('error', 'Er is een fout opgetreden. Probeer het opnieuw.');
            return redirect('/producten');
        }
    }
}
