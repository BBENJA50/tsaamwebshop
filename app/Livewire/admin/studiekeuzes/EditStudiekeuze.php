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
    public $studiekeuze;
    public $name;
    public $campusses;
    public $campus_id;
    public $grades;
    public $grade_id;
    public $academic_years;
    public $academic_year_id;
    public $study_fields;
    public $study_field_id;
    public $products = [];
    public $selectedProducts = [];
    public $search = '';

    protected $rules = [
        'campus_id' => 'required|not_in:Selecteer een campus',
        'name' => 'required',
        'grade_id' => 'required',
        'academic_year_id' => 'required',
        'study_field_id' => 'required',
    ];

    protected $messages = [
        'campus_id.not_in' => 'Selecteer een campus',
    ];

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

    public function updateName()
    {
        $grade = Grade::find($this->grade_id);
        $studyField = StudyField::find($this->study_field_id);
        $campus = Campus::find($this->campus_id);

        $this->name = ($campus ? $campus->name : '') . ' - ' . ($grade ? $grade->name : '') . ' - ' . ($studyField ? $studyField->name : '');
    }

    public function selectProduct($productId)
    {
        if (!in_array($productId, $this->selectedProducts)) {
            $this->selectedProducts[] = $productId;
        }
    }

    public function removeProduct($productId)
    {
        $this->selectedProducts = array_values(array_filter($this->selectedProducts, function ($item) use ($productId) {
            return $item != $productId;
        }));
    }

    public function moveSelectedProducts()
    {
        foreach ($this->products as $product) {
            if (in_array($product->id, $this->products->pluck('id')->toArray()) && !in_array($product->id, $this->selectedProducts)) {
                $this->selectedProducts[] = $product->id;
            }
        }
    }

    public function updating($key): void
    {
        if ($key === 'search') {
            $this->products = Product::where('name', 'like', '%' . $this->search . '%')->get();
        }
    }

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
