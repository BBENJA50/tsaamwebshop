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
    public $product_id; // Variabele om product-id op te slaan
    public Product $product; // Variabele om een Product object op te slaan
    public $name; // Variabele om de naam van het product op te slaan
    public $description; // Variabele om de beschrijving van het product op te slaan
    public $price; // Variabele om de prijs van het product op te slaan
    public $categories; // Variabele om de categorieën op te slaan
    public $category_id; // Variabele om de categorie-id op te slaan
    public $attributen; // Variabele om de attributen op te slaan
    public $attributeOptions; // Variabele om de attribuutopties op te slaan
    public $attribute_id; // Variabele om de attribuut-id op te slaan
    public $selectedAttribute; // Variabele om het geselecteerde attribuut op te slaan
    public $subjects; // Variabele om de onderwerpen op te slaan
    public $subject_id; // Variabele om de onderwerp-id op te slaan
    public $studiekeuzes; // Variabele om de studiekeuzes op te slaan
    public $selectedStudiekeuzes = []; // Variabele om de geselecteerde studiekeuzes op te slaan
    public $academic_years; // Variabele om de academische jaren op te slaan
    public $selectedAcademicYear = 3; // Variabele om het geselecteerde academische jaar op te slaan
    public $campusses; // Variabele om de campussen op te slaan
    public $selectedCampus = 1; // Variabele om de geselecteerde campus op te slaan

    // Methode om het component te mounten met een specifiek product-id
    public function mount($id)
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

    // Methode om het geselecteerde attribuut bij te werken
    public function changeSelectedAttribute($id)
    {
        $this->selectedAttribute = $id - 1;
    }

    // Methode om het geselecteerde academische jaar bij te werken
    public function updatedSelectedAcademicYear($value)
    {
        $this->selectedAcademicYear = $value;
    }

    // Methode om de geselecteerde campus bij te werken
    public function updateSelectedCampus($value)
    {
        $this->selectedCampus = $value;
    }

    // Methode om het product bij te werken
    public function update()
    {
        // Validatie van de invoerwaarden
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'attribute_id' => 'required',
            'subject_id' => 'required',
        ]);

        // Wijzig details van het product
        try {
            Product::where('id', $this->product_id)->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'category_id' => $this->category_id,
                'attribute_id' => $this->attribute_id,
                'subject_id' => $this->subject_id,
                'updated_at' => now()
            ]);

            // Koppel de geselecteerde studiekeuzes aan het product
            $product = Product::where('id', $this->product_id)->first();
            $product->studiekeuzes()->sync($this->selectedStudiekeuzes);

            // Redirect naar de productlijst na succesvol opslaan
            $this->redirect('/producten', navigate: true);
        } catch (\Exception $th) {
            // Toon foutmelding bij mislukking
            dd($th);
        }
    }

    // Methode om de componentweergave te renderen
    public function render()
    {
        $this->subjects = Subject::all(); // Haal alle onderwerpen op
        $this->categories = Category::all(); // Haal alle categorieën op
        $this->attributen = Attribute::all(); // Haal alle attributen op
        $this->attributeOptions = AttributeOption::all(); // Haal alle attribuutopties op
        $this->studiekeuzes = Studiekeuze::orderBy('name')->get(); // Haal alle studiekeuzes op
        $this->academic_years = AcademicYear::all(); // Haal alle academische jaren op
        $this->campusses = Campus::all(); // Haal alle campussen op

        return view('livewire.public.products.edit-product'); // Toon de weergave voor het bewerken van producten
    }
}
