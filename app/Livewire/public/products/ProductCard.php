<?php

namespace App\Livewire\public\products;

use App\Models\Product;
use Livewire\Component;

class ProductCard extends Component
{
    public $product;
    public $category;
    public $attribute;
    public $subject;
    public $attributeOptions;
    public $studiekeuze;

    public function addToCart( $id)
    {
        $cart = session('cart', []);
        $productId = $id;
        $product = Product::find($productId);

//        Als product al in cart zit doen we +1 hoeveelheid
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ];
        }
        session(['cart' => $cart]);
        return $cart;
    }

    public function render()
    {
        $this->product = $this->product;
        $this->category = $this->product->category;
        $this->attribute = $this->product->attribute;
        $this->subject = $this->product->subject;
        $this->attributeOptions = $this->product->attribute->attributeOptions;
        $this->studiekeuze = $this->product->studiekeuze;

        return view('livewire.public.products.product-card');
    }
}
