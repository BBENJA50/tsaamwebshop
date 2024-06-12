<?php

namespace App\Livewire\public\products;

use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\Component;

class ProductCard extends Component
{
    public $product;
    public $category;
    public $attribute;
    public $subject;
    public $attributeOptions;
    public $studiekeuze;

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found!');
        }

        // Add product to cart
        $cart = session()->get('cart', []);
        $cart[$productId] = [
            'name' => $product->name,
            'price' => $product->price,
        ];
        session()->put('cart', $cart);

        dd(session()->get('cart'));
        return redirect()->route('products.index')->with('success', 'Product added to cart successfully!');
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
