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
use Livewire\WithFileUploads;


class AddProduct extends Component
{
    use WithFileUploads;

    public $name;
    public $price;
    public $description;
    public $categories;
    public $category_id;
    public $attributen;
    public $attributeOptions;
    public $attribute_id;
    public $selectedAttribute = 0;
    public $subjects;
    public $subject_id;
    public $studiekeuzes;
    public $selectedStudiekeuzes = [];
    public $academic_years;
    public $selectedAcademicYear = 3;
    public $campusses;
    public $image;
    public $selectedCampus = 1;


    public function changeSelectedAttribute($id)
    {
        $this->selectedAttribute = $id - 1;
    }
    public function updatedSelectedAcademicYear($value)
    {
        $this->studiekeuzes = Studiekeuze::where('academic_year_id', $value)->orderBy('name')->get();
    }
    public function updateSelectedCampus($value)
    {
        $this->selectedCampus = Campus::where('id', $value)->first()->name;
    }

    public function saveProduct()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'attribute_id' => 'required',
            'subject_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $product =Product::create([
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
                'category_id' => $this->category_id,
                'attribute_id' => $this->attribute_id,
                'subject_id' => $this->subject_id,
                'image' => $this->image->store('products', 'public'),
            ]);


            foreach ($this->selectedStudiekeuzes as $key => $value) {
                $product->studiekeuzes()->attach($value);
            }
            return $this->redirect('/admin/producten', navigate: true);

        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function render()
    {
        $this->studiekeuzes = Studiekeuze::orderBy('name')->get();
        $this->campusses = Campus::orderBy('name')->get();
        $this->categories = Category::all();
        $this->attributen = Attribute::all();
        $this->attributeOptions = AttributeOption::all();
        $this->subjects = Subject::all();
        $this->academic_years = AcademicYear::all();
        return view('livewire.public.products.add-product');
    }
}
