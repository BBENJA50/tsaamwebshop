<?php

namespace App\Livewire\public\products;

use App\Models\Product;
use Livewire\Component;

class ShoppingCart extends Component
{
    public $cart = [];
    public $children = [];
    public $child;
    public $studiekeuze_id;
    public $totalItems = 0;
    public $cartTotal = 0;

    public function mount($childId = null)
    {
        if ($childId) {
            $this->child = auth()->user()->children()->find($childId);

            if (!$this->child) {
                session()->flash('error', 'Geen kind gevonden');
                return redirect('/producten');
            }

            $this->studiekeuze_id = $this->child->studiekeuze_id;
        } else {
            $this->child = null;
        }

        $this->cart = session()->get('cart', []);
        $this->children = auth()->user()->children;

        $this->updateCartMetrics();
    }

//    public function addToCart($productId)
//    {
//        $existingProductIndex = array_search($productId, array_column($this->cart, 'id'));
//
//        if ($existingProductIndex !== false && $this->cart[$existingProductIndex]['child_id'] == $this->child->id) {
//            $this->cart[$existingProductIndex]['quantity']++;
//        } else {
//            $this->cart[] = [
//                'id' => $productId,
//                'image' => Product::find($productId)->image,
//                'quantity' => 1,
//                'price' => Product::find($productId)->price,
//                'name' => Product::find($productId)->name,
//                'child_id' => $this->child->id ?? null,  // Include child ID, handle null case
//            ];
//        }
//
//        session()->put('cart', $this->cart);
//        $this->updateCartMetrics();
//    }

    public function removeProductFromCart($productId)
    {
        $this->cart = array_filter($this->cart, function($item) use ($productId) {
            return $item['id'] !== $productId;
        });

        session()->put('cart', $this->cart);
        $this->updateCartMetrics();
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
    }

    public function render()
    {


        return view('livewire.public.products.shopping-cart', [
            'cart' => $this->cart,
            'children' => $this->children,
            $this->updateCartMetrics(),

        ]);
    }
}
