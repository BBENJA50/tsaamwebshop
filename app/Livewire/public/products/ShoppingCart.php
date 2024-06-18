<?php

namespace App\Livewire\public\products;

use App\Models\Product;
use Livewire\Component;

class ShoppingCart extends Component
{
    public $cart = [];
    public $children = [];
    public $parent;
    public $child;
    public $studiekeuze_id;
    public $totalItems = 0;
    public $cartTotal = 0;

    public function mount($childId = null)
    {
        $this->parent = auth()->user();
        $this->children = $this->parent->children;
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
        $this->updateCartMetrics();
    }

    public function updateQuantity($productId, $quantity, $attributeOption = null, $childId = null)
    {
        $existingProductIndex = null;
        foreach ($this->cart as $index => $cartItem) {
            if ($cartItem['id'] == $productId && $cartItem['child_id'] == $childId && $cartItem['attribute_option'] == $attributeOption) {
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

    public function removeProductFromCart($productId, $attributeOption = null, $childId = null)
    {
        $this->cart = array_filter($this->cart, function($item) use ($productId, $attributeOption, $childId) {
            $attributeCondition = ($attributeOption === null) ? $item['attribute_option'] === null : $item['attribute_option'] == $attributeOption;
            return !($item['id'] == $productId && $attributeCondition && $item['child_id'] == $childId);
        });

        $this->cart = array_values($this->cart);

        session()->put('cart', $this->cart);
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
            'parent' => $this->parent,
            'child' => $this->child,
            'totalItems' => $this->totalItems,
            'cartTotal' => $this->cartTotal,
        ]);
    }
}
