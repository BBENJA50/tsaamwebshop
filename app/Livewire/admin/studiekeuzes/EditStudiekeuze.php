<?php

namespace App\Livewire\admin\studiekeuzes;

use App\Models\AcademicYear;
use App\Models\Campus;
use App\Models\Grade;
use App\Models\Product;
use App\Models\Studiekeuze;
use App\Models\StudyField;
use Exception;
use Livewire\Component;

class EditStudiekeuze extends Component
{
    public $studiekeuze; // De studiekeuze die wordt bewerkt
    public $name; // Naam van de studiekeuze
    public $campusses; // Alle campussen
    public $campus_id; // Geselecteerde campus ID
    public $grades; // Alle klassen
    public $grade_id; // Geselecteerde klasse ID
    public $academic_years; // Alle academische jaren
    public $academic_year_id; // Geselecteerd academisch jaar ID
    public $study_fields; // Alle studierichtingen
    public $study_field_id; // Geselecteerde studierichting ID
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

    // Initialisatie van de component met de studiekeuze gegevens
    public function mount($id)
    {
        $this->studiekeuze = Studiekeuze::findOrFail($id);
        $this->name = $this->studiekeuze->name;
        $this->campus_id = $this->studiekeuze->campus_id;
        $this->grade_id = $this->studiekeuze->grade_id;
        $this->academic_year_id = $this->studiekeuze->academic_year_id;
        $this->study_field_id = $this->studiekeuze->study_field_id;
        $this->selectedProducts = $this->studiekeuze->products->pluck('id')->toArray();
    }

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
        foreach ($this->products as $product) {
            if (in_array($product->id, $this->products->pluck('id')->toArray()) && !in_array($product->id, $this->selectedProducts)) {
                $this->selectedProducts[] = $product->id;
            }
        }
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
            $this->studiekeuze->update([
                'name' => $this->name,
                'campus_id' => $this->campus_id,
                'grade_id' => $this->grade_id,
                'academic_year_id' => $this->academic_year_id,
                'study_field_id' => $this->study_field_id,
            ]);

            $this->studiekeuze->products()->sync($this->selectedProducts);

            return redirect('/admin/studiekeuzes');
        } catch (Exception $e) {
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

        return view('livewire.admin.studiekeuzes.edit-studiekeuze', [
            'products' => $this->products,
            'selectedProductsDetails' => $selectedProductsDetails
        ]);
    }
}
