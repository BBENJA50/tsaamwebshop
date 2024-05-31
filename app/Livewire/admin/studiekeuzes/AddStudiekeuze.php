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
    public $name;
    public $campusses;
    public $campus_id = 'Selecteer een campus';
    public $grades;
    public $grade_id;
    public $academic_years;
    public $academic_year_id = 3;
    public $study_fields;
    public $study_field_id;
    public $createNew = false;
    public $products;
    public $selectedProducts = [];
    public $selectedAcademicYear = 3;
    public $selectedCampus = 1;
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
    public function updateName()
    {
        $grade = Grade::find($this->grade_id);
        $studyField = StudyField::find($this->study_field_id);
        $campus = Campus::find($this->campus_id);

        $this->name = ( $campus ? $campus->name : '') . ' - ' . ($grade ? $grade->name : '') . ' - ' . ($studyField ? $studyField->name : '');
    }

    public function selectProduct($product_id)
    {
        if (in_array($product_id, $this->selectedProducts)) {
            unset($this->selectedProducts[array_search($product_id, $this->selectedProducts)]);
        } else {
            $this->selectedProducts[] = $product_id;
        }
    }
    public function updating($key): void
    {
        if ($key ==='search') {
            $this->products = Product::where('name', 'like', '%' . $this->search . '%')->get();
        }
    }

    public function saveStudiekeuze()
    {
        $this->validate();

        try {
            $studiekeuze =Studiekeuze::create([
                'name' => $this->name,
                'campus_id' => $this->campus_id,
                'grade_id' => $this->grade_id,
                'academic_year_id' => $this->academic_year_id,
                'study_field_id' => $this->study_field_id,
            ]);

            foreach ($this->selectedProducts as $product_id) {
                $studiekeuze->products()->attach($product_id);
            }

            if ($this->createNew) {
                // Reset properties if creating a new record
                $this->reset(['campus_id', 'name', 'grade_id', 'academic_year_id', 'study_field_id', 'createNew']);
                session()->flash('message', 'Studiekeuze successfully created.');
            } else {
                return redirect('/studiekeuzes');
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        $this->campusses = Campus::all();
        $this->grades = Grade::all();
        $this->academic_years = AcademicYear::all();
        $this->study_fields = StudyField::all();
        $this->products = Product::orderBy('name')->get()
        ->when($this->search !== '', function ($query) {
        if ($this->search !== '') {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        });
        return view('livewire.admin.studiekeuzes.add-studiekeuze');
    }
}
