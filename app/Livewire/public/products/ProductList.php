<?php

namespace App\Livewire\public\products;

use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
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
    public $myCount = 0;
    public $selectedAttributeOptions = [];
    public $productErrors = [];

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
        $product = Product::find($productId);

        // Check if the product has an attribute with id > 1 and ensure an option is selected
        if ($product->attribute_id > 1 && empty($this->selectedAttributeOptions[$productId])) {
            $this->productErrors[$productId] = 'Selecteer een maat voor het product.';
            return;
        }

        unset($this->productErrors[$productId]);

        $existingProductIndex = null;
        foreach ($this->cart as $index => $cartItem) {
            if ($cartItem['id'] == $productId && $cartItem['child_id'] == $this->child->id && $cartItem['attribute_option'] == ($this->selectedAttributeOptions[$productId] ?? null)) {
                $existingProductIndex = $index;
                break;
            }
        }

        $this->myCount++;
        // Check if the product is already in the cart
        if ($existingProductIndex !== null) {
            $this->cart[$existingProductIndex]['quantity']++;
        } else {
            $this->cart[] = [
                'id' => $productId,
                'image' => $product->image,
                'quantity' => 1,
                'price' => $product->price,
                'name' => $product->name,
                'child_id' => $this->child->id ?? null,
                'attribute_option' => $this->selectedAttributeOptions[$productId] ?? null,
            ];
        }
        session()->flash('message', 'Product toegevoegd.');

        session()->put('cart', $this->cart);
        session()->put('myCount', $this->myCount);

        $this->updateCartMetrics();

        $this->dispatch('added');
    }


    public function updateQuantity($productId, $quantity, $attributeOption = null)
    {
        $existingProductIndex = null;
        foreach ($this->cart as $index => $cartItem) {
            if ($cartItem['id'] == $productId && $cartItem['attribute_option'] == $attributeOption) {
                $existingProductIndex = $index;
                break;
            }
        }

        if ($existingProductIndex !== null) {
            $this->cart[$existingProductIndex]['quantity'] = $quantity;
            if ($this->cart[$existingProductIndex]['quantity'] <= 0) {
                unset($this->cart[$existingProductIndex]);
            }
        }

        $this->cart = array_values($this->cart);

        session()->put('cart', array_values($this->cart)); // Re-index the array
        $this->updateCartMetrics();
    }


    public function removeProductFromCart($productId)
    {
        $this->cart = array_filter($this->cart, function ($item) use ($productId) {
            return $item['id'] !== $productId;
        });

        $this->cart = array_values($this->cart);

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

        $products = $query->orderBy('name')->get();

        $categories = Category::whereHas('products', function ($query) {
            if ($this->child) {
                $query->whereHas('studiekeuzes', function ($query) {
                    $query->where('studiekeuzes.id', $this->child->studiekeuze->id);
                });
            }
        })->orderBy('name')->get();

        return view('livewire.public.products.product-list', [
            'products' => $products,
            'categories' => $categories,
            'myCount' => $this->myCount,
            'attributes' => Attribute::with('attributeOptions')->get(),
        ]);
    }
}
