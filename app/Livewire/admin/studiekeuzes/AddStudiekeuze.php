<?php

namespace App\Livewire\admin\studiekeuzes;

use App\Models\AcademicYear;
use App\Models\Campus;
use App\Models\Grade;
use App\Models\Product;
use App\Models\Studiekeuze;
use App\Models\StudyField;
use Livewire\Component;

class AddStudiekeuze extends Component
{
    public $name; // Naam van de studiekeuze
    public $campusses; // Alle campussen
    public $campus_id = 'Selecteer een campus'; // Geselecteerde campus ID
    public $grades; // Alle klassen
    public $grade_id; // Geselecteerde klasse ID
    public $academic_years; // Alle academische jaren
    public $academic_year_id = 3; // Geselecteerd academisch jaar ID
    public $study_fields; // Alle studierichtingen
    public $study_field_id; // Geselecteerde studierichting ID
    public $createNew = false; // Flag om nieuwe studiekeuze te maken
    public $products = []; // Alle producten
    public $selectedProducts = []; // Geselecteerde producten
    public $search = ''; // Zoekterm

    // Validatieregels
    protected $rules = [
        'campus_id' => 'required|not_in:Selecteer een campus',
        'name' => 'required',
        'grade_id' => 'required',
        'academic_year_id' => 'required',
        'study_field_id' => 'required',
    ];

    // Validatieberichten
    protected $messages = [
        'campus_id.not_in' => 'Selecteer een campus',
    ];

    // Update de naam van de studiekeuze
    public function updateName()
    {
        $grade = Grade::find($this->grade_id);
        $studyField = StudyField::find($this->study_field_id);
        $campus = Campus::find($this->campus_id);

        $this->name = ($campus ? $campus->name : '') . ' - ' . ($grade ? $grade->name : '') . ' - ' . ($studyField ? $studyField->name : '');
    }

    // Selecteer een product
    public function selectProduct($productId)
    {
        if (!in_array($productId, $this->selectedProducts)) {
            $this->selectedProducts[] = $productId;
        }
    }

    // Verwijder een product
    public function removeProduct($productId)
    {
        $this->selectedProducts = array_values(array_filter($this->selectedProducts, function ($item) use ($productId) {
            return $item != $productId;
        }));
    }

    // Verplaats geselecteerde producten
    public function moveSelectedProducts()
    {
        $productsArray = $this->products->pluck('id')->toArray();
        $this->selectedProducts = array_merge($this->selectedProducts, array_diff($productsArray, $this->selectedProducts));
    }

    // Bijwerken van zoekopdracht
    public function updating($key): void
    {
        if ($key === 'search') {
            $this->products = Product::where('name', 'like', '%' . $this->search . '%')->get();
        }
    }

    // Opslaan van de studiekeuze
    public function saveStudiekeuze()
    {
        $this->validate();

        try {
            $studiekeuze = Studiekeuze::create([
                'name' => $this->name,
                'campus_id' => $this->campus_id,
                'grade_id' => $this->grade_id,
                'academic_year_id' => $this->academic_year_id,
                'study_field_id' => $this->study_field_id,
            ]);

            foreach ($this->selectedProducts as $product_id) {
                if (is_numeric($product_id)) {
                    $studiekeuze->products()->attach($product_id);
                }
            }

            if ($this->createNew) {
                $this->reset(['campus_id', 'name', 'grade_id', 'academic_year_id', 'study_field_id', 'createNew', 'selectedProducts']);
                session()->flash('message', 'Studiekeuze succesvol aangemaakt.');
            } else {
                return redirect('/admin/studiekeuzes');
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    // Render de Livewire component view
    public function render()
    {
        $this->campusses = Campus::all();
        $this->grades = Grade::all();
        $this->academic_years = AcademicYear::all();
        $this->study_fields = StudyField::all();
        $this->products = Product::orderBy('name')
            ->when($this->search !== '', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->get();

        $selectedProductsDetails = Product::whereIn('id', $this->selectedProducts)->get()->sortBy('name');

        return view('livewire.admin.studiekeuzes.add-studiekeuze', [
            'products' => $this->products,
            'selectedProductsDetails' => $selectedProductsDetails
        ]);
    }
}
