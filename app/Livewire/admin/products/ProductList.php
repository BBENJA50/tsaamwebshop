<?php

namespace App\Livewire\admin\products;

use App\Models\Category;
use App\Models\Product;
use App\Models\Studiekeuze;
use Exception;
use Livewire\Component;

class ProductList extends Component
{
    public $child;
    public $category_id;

    public function mount($childId = null)
    {
        if (!auth()->user()->hasRole('admin') && $childId) {
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

        $query = Product::query();

        if (auth()->user()->hasRole('admin')) {
            // Admin can see all products regardless of category
        } else {
            if ($this->child) {
                $query->whereHas('studiekeuzes', function ($query) {
                    $query->where('studiekeuzes.id', $this->child->studiekeuze->id);
                });
            } else {
                // No child selected, potentially show no products
                return; // Adjust this based on your needs
            }
        }

        // Handle "All categories" selection (when $category_id is null)
        if (is_null($category_id)) {
            // Don't apply any additional filtering
        } else {
            $query->where('category_id', $category_id);
        }

        $products = $query->with('category')->get();


        return view('livewire.admin.products.product-list', [
            'products' => $products,
        ]);
    }


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
                if ($this->category_id) {
                    $query->where('category_id', $category_id);
                }
                $products = $query->get();

                $categories = Category::whereHas('products')->get();

                return view('livewire.admin.products.product-list', [
                    'studiekeuzes' => Studiekeuze::all(),
                    'products' => $products,
                    'categories' => $categories,
                ]);
            } else {
                if ($this->child) {
                    $query->whereHas('studiekeuzes', function ($query) {
                        $query->where('studiekeuzes.id', $this->child->studiekeuze->id);
                    });

                    if ($this->category_id) {
                        $query->where('category_id', $category_id);
                    }

                    $products = $query->get();
                } else {
                    $products = collect();
                }

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
                        ])
                ]);
            }
        } catch (Exception $e) {
            logger()->error('Error in ProductList component: ' . $e->getMessage());
            session()->flash('error', 'Er is een fout opgetreden. Probeer het opnieuw.');
            return redirect('/producten');
        }
    }
}
