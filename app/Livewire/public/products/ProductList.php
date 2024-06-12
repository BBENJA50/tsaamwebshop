<?php

namespace App\Livewire\public\products;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ProductList extends Component
{
    public $child;
    public $category_id = [];
    public $studiekeuze_id;
    public $cart = [];
    public $totalItems = 0;
    public $cartTotal = 0;
    public $myCount= 0;

    public function mount($childId = null)
    {
        if ($childId) {
            $this->child = auth()->user()->children()->find($childId);

            if (!$this->child) {
                session()->flash('error', 'Geen kind gevonden');
                return redirect('/producten');
            }
            $this->studiekeuze_id = $this->child->studiekeuze_id;
        }

        $this->cart = session()->get('cart', []);
        $this->myCount = session('myCount', 0);
        $this->updateCartMetrics();
    }

    public function filterByCategory(array $selectedCategories)
    {
        $this->category_id = $selectedCategories;
    }

    public function addProductToCart($productId)
    {
        $existingProductIndex = array_search($productId, array_column($this->cart, 'id'));

        $this->myCount++;
        if ($existingProductIndex !== false)   {
            $this->cart[$existingProductIndex]['quantity']++;
        } else {
            $this->cart[] = [
                'id' => $productId,
                'image' => Product::find($productId)->image,
                'quantity' => 1,
                'price' => Product::find($productId)->price,
                'name' => Product::find($productId)->name,
                'child_id' => $this->child->id ?? null,
            ];
        }
        session()->flash('message', 'Product toegevoegd.');

        session()->put('cart', $this->cart);
        session()->put('myCount',$this->myCount);


        $this->updateCartMetrics();

        $this->dispatch('added');
    }

    public function updateQuantity($productId, $quantity)
    {
        $existingProductIndex = array_search($productId, array_column($this->cart, 'id'));

        if ($existingProductIndex !== false) {
            $this->cart[$existingProductIndex]['quantity'] = $quantity;
            if ($this->cart[$existingProductIndex]['quantity'] <= 0) {
                unset($this->cart[$existingProductIndex]);
            }
        }

        session()->put('cart', array_values($this->cart)); // Re-index the array
        session()->put('myCount', $this->myCount);
        $this->updateCartMetrics();
    }

    public function removeProductFromCart($productId)
    {
        $this->cart = array_filter($this->cart, function($item) use ($productId) {
            return $item['id'] !== $productId;
        });

        session()->put('cart', $this->cart);
        session()->put('myCount', $this->myCount);
        $this->updateCartMetrics();
    }

    public function updateCartMetrics()
    {
        $this->cartTotal = 0;
        $this->totalItems = 0;
        foreach ($this->cart as $item) {
            $this->cartTotal += $item['price'] * $item['quantity'];
            $this->totalItems += $item['quantity'];
        }
        $this->myCount = array_sum(array_column($this->cart, 'quantity'));
        session()->put('myCount', $this->myCount);
       // $this->render();
    }

    public function render()
    {
        $query = Product::query();

        if ($this->child) {
            $query->whereHas('studiekeuzes', function ($query) {
                $query->where('studiekeuzes.id', $this->child->studiekeuze->id);
            });

            if (!empty($this->category_id)) {
                $query->whereIn('category_id', $this->category_id);
            }
        }

        $products = $query->get();

        return view('livewire.public.products.product-list', [
            'products' => $products,
            'categories' => Category::all(),
            'myCount' => $this->myCount
        ]);
    }
}
