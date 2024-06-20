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
    use WithFileUploads; // Voeg functionaliteit toe om bestanden te uploaden

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

    // Methode om het geselecteerde attribuut bij te werken
    public function changeSelectedAttribute($id)
    {
        $this->selectedAttribute = $id - 1;
    }

    // Methode om de studiekeuzes bij te werken wanneer het academisch jaar verandert
    public function updatedSelectedAcademicYear($value)
    {
        $this->studiekeuzes = Studiekeuze::where('academic_year_id', $value)->orderBy('name')->get();
    }

    // Methode om de geselecteerde campus bij te werken
    public function updateSelectedCampus($value)
    {
        $this->selectedCampus = Campus::where('id', $value)->first()->name;
    }

    // Methode om een product op te slaan
    public function saveProduct()
    {
        // Validatie van de invoerwaarden
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
            // Maak een nieuw product aan met de ingevoerde waarden
            $product = Product::create([
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
                'category_id' => $this->category_id,
                'attribute_id' => $this->attribute_id,
                'subject_id' => $this->subject_id,
                'image' => $this->image->store('products', 'public'), // Sla de afbeelding op in de 'public' opslag
            ]);

            // Koppel de geselecteerde studiekeuzes aan het product
            foreach ($this->selectedStudiekeuzes as $key => $value) {
                $product->studiekeuzes()->attach($value);
            }

            // Redirect naar de productlijst na succesvol opslaan
            return $this->redirect('/admin/producten', navigate: true);

        } catch (\Exception $e) {
            // Toon foutmelding bij mislukking
            dd($e);
        }
    }

    // Methode om de componentweergave te renderen
    public function render()
    {
        $this->studiekeuzes = Studiekeuze::orderBy('name')->get(); // Haal alle studiekeuzes op
        $this->campusses = Campus::orderBy('name')->get(); // Haal alle campussen op
        $this->categories = Category::all(); // Haal alle categorieën op
        $this->attributen = Attribute::all(); // Haal alle attributen op
        $this->attributeOptions = AttributeOption::all(); // Haal alle attribuutopties op
        $this->subjects = Subject::all(); // Haal alle onderwerpen op
        $this->academic_years = AcademicYear::all(); // Haal alle academische jaren op

        return view('livewire.public.products.add-product'); // Toon de weergave voor het toevoegen van producten
    }
}
