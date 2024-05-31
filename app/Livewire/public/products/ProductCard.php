<?php

namespace App\Livewire\public\products;

use Livewire\Component;

class ProductCard extends Component
{
    public $product;
    public $category;
    public $attribute;
    public $subject;
    public $attributeOptions;
    public $studiekeuze;

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
