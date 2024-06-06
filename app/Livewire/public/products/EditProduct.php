<?php

namespace App\Livewire\public\products;

use App\Models\AcademicYear;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Campus;
use App\Models\Category;
use App\Models\Product;
use App\Models\Studiekeuze;
use App\Models\Subject;
use Livewire\Component;

class EditProduct extends Component
{
    public $product_id;
    public Product $product;
    public $name;
    public $description;
    public $price;
    public $categories;
    public $category_id;
    public $attributen;
    public $attributeOptions;
    public $attribute_id;
    public $selectedAttribute;
    public $subjects;
    public $subject_id;
    public $studiekeuzes;
    public $selectedStudiekeuzes = [];
    public $academic_years;
    public $selectedAcademicYear = 3;
    public $campusses;
    public $selectedCampus = 1;

    public function mount( $id )
    {
        $this->product_id = $id;
        $this->product = Product::where('id', $id)->first();
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
        $this->category_id = $this->product->category_id;
        $this->attribute_id = $this->product->attribute_id;
        $this->selectedAttribute = $this->attribute_id - 1;
        $this->subject_id = $this->product->subject_id;
        $this->studiekeuzes = $this->product->studiekeuzes;
        $this->selectedStudiekeuzes = $this->studiekeuzes->pluck('id')->toArray();
        $this->academic_years = $this->product->academic_years;
        $this->campusses = $this->product->campusses;

    }

    public function changeSelectedAttribute($id)
    {
        $this->selectedAttribute = $id - 1;
    }

    public function updatedSelectedAcademicYear($value)
    {
        $this->selectedAcademicYear = $value;
    }
    public function updateSelectedCampus($value)
    {
        $this->selectedCampus = $value;
    }

    public function update()
    {
        //validation
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'attribute_id' => 'required',
            'subject_id' => 'required',
        ]);
        //edit details
        try {
            $product = Product::where('id', $this->product_id)->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'category_id' => $this->category_id,
                'attribute_id' => $this->attribute_id,
                'subject_id' => $this->subject_id,
                'updated_at' => now()
            ]);

            $product = Product::where('id', $this->product_id)->first();
            $product->studiekeuzes()->sync($this->selectedStudiekeuzes);

            // redirect
            $this->redirect('/producten', navigate: true);
        } catch (\Exception $th) {
            dd($th);
        }
    }
    public function render()
    {
        $this->subjects = Subject::all();
        $this->categories = Category::all();
        $this->attributen = Attribute::all();
        $this->attributeOptions = AttributeOption::all();
        $this->studiekeuzes = Studiekeuze::orderBy('name')->get();
        $this->academic_years = AcademicYear::all();
        $this->campusses = Campus::all();

        return view('livewire.public.products.edit-product');
    }
}
