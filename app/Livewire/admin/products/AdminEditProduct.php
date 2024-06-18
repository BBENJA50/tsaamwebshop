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

class AdminEditProduct extends Component
{
    public $product_id; // ID van het product
    public Product $product; // Product model
    public $name; // Naam van het product
    public $description; // Beschrijving van het product
    public $price; // Prijs van het product
    public $categories; // Alle categorieën
    public $category_id; // Geselecteerde categorie ID
    public $attributen; // Alle attributen
    public $attributeOptions; // Alle attribuutopties
    public $attribute_id; // Geselecteerde attribuut ID
    public $selectedAttribute; // Geselecteerde attribuut index
    public $subjects; // Alle vakken
    public $subject_id; // Geselecteerde vak ID
    public $studiekeuzes; // Alle studiekeuzes
    public $selectedStudiekeuzes = []; // Geselecteerde studiekeuzes
    public $academic_years; // Alle academische jaren
    public $selectedAcademicYear = 3; // Geselecteerd academisch jaar
    public $campusses; // Alle campussen
    public $selectedCampus = 1; // Geselecteerde campus

    /**
     * Initializeer de component met het product ID en laad de productgegevens.
     *
     * @param int $id
     */
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
     * Update de geselecteerde academisch jaar.
     *
     * @param int $value
     */
    public function updatedSelectedAcademicYear($value)
    {
        $this->selectedAcademicYear = $value;
    }

    /**
     * Update de geselecteerde campus.
     *
     * @param int $value
     */
    public function updateSelectedCampus($value)
    {
        $this->selectedCampus = $value;
    }

    /**
     * Werk het product bij in de database.
     */
    public function update()
    {
        // Validatie van de invoer
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'attribute_id' => 'required',
            'subject_id' => 'required',
        ]);

        try {
            // Werk de productgegevens bij in de database
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

            // Redirect naar de producten pagina
            $this->redirect('/admin/producten', navigate: true);
        } catch (\Exception $th) {
            dd($th);
        }
    }

    /**
     * Render de Livewire component view.
     */
    public function render()
    {
        $this->subjects = Subject::all();
        $this->categories = Category::all();
        $this->attributen = Attribute::all();
        $this->attributeOptions = AttributeOption::all();
        $this->studiekeuzes = Studiekeuze::orderBy('name')->get();
        $this->academic_years = AcademicYear::all();
        $this->campusses = Campus::all();

        return view('livewire.admin.products.edit-product');
    }
}
