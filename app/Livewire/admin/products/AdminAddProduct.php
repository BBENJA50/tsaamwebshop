<?php

namespace App\Livewire\admin\products;

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

class AdminAddProduct extends Component
{
    use WithFileUploads;

    public $name; // Naam van het product
    public $price; // Prijs van het product
    public $description; // Beschrijving van het product
    public $categories; // Alle categorieën
    public $category_id; // Geselecteerde categorie ID
    public $attributen; // Alle attributen
    public $attributeOptions; // Alle attribuutopties
    public $attribute_id; // Geselecteerde attribuut ID
    public $selectedAttribute = 0; // Geselecteerde attribuut index
    public $subjects; // Alle vakken
    public $subject_id; // Geselecteerde vak ID
    public $studiekeuzes; // Alle studiekeuzes
    public $selectedStudiekeuzes = []; // Geselecteerde studiekeuzes
    public $academic_years; // Alle academische jaren
    public $selectedAcademicYear = 3; // Geselecteerd academisch jaar
    public $campusses; // Alle campussen
    public $image; // Afbeelding van het product
    public $selectedCampus = 1; // Geselecteerde campus

    /**
     * Wijzig de geselecteerde attribuut index.
     *
     * @param int $id
     */
    public function changeSelectedAttribute($id)
    {
        $this->selectedAttribute = $id - 1;
    }

    /**
     * Update de studiekeuzes op basis van het geselecteerde academische jaar.
     *
     * @param int $value
     */
    public function updatedSelectedAcademicYear($value)
    {
        $this->studiekeuzes = Studiekeuze::where('academic_year_id', $value)->orderBy('name')->get();
    }

    /**
     * Update de geselecteerde campus.
     *
     * @param int $value
     */
    public function updateSelectedCampus($value)
    {
        $this->selectedCampus = Campus::where('id', $value)->first()->name;
    }

    /**
     * Sla het product op in de database.
     */
    public function saveProduct()
    {
        // Validatie van de invoer
        $this->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'attribute_id' => 'required',
            'subject_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = $this->name . date('d-m-Y-H-i'); // Genereer de afbeelding naam

        try {
            // Maak het product aan in de database
            $product = Product::create([
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
                'category_id' => $this->category_id,
                'attribute_id' => $this->attribute_id,
                'subject_id' => $this->subject_id,
                'image' => $imageName . '.' . $this->image->extension(),
            ]);

            // Sla de afbeelding op
            $this->image->storeAs('public/images', $imageName . '.' . $this->image->extension());
            $product->image = $imageName . '.' . $this->image->extension();
            $product->save();

            // Koppel de geselecteerde studiekeuzes aan het product
            foreach ($this->selectedStudiekeuzes as $key => $value) {
                $product->studiekeuzes()->attach($value);
            }

            // Redirect naar de producten pagina
            return $this->redirect('/admin/producten', navigate: true);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Render de Livewire component view.
     */
    public function render()
    {
        $this->studiekeuzes = Studiekeuze::orderBy('name')->get();
        $this->campusses = Campus::orderBy('name')->get();
        $this->categories = Category::all();
        $this->attributen = Attribute::all();
        $this->attributeOptions = AttributeOption::all();
        $this->subjects = Subject::all();
        $this->academic_years = AcademicYear::all();

        return view('livewire.admin.products.add-product');
    }
}
