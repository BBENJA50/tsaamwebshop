<?php

namespace App\Livewire\studiekeuzes;

use App\Models\AcademicYear;
use App\Models\Campus;
use App\Models\Grade;
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

    public function saveStudiekeuze()
    {
        $this->validate();

        try {
            Studiekeuze::create([
                'name' => $this->name,
                'campus_id' => $this->campus_id,
                'grade_id' => $this->grade_id,
                'academic_year_id' => $this->academic_year_id,
                'study_field_id' => $this->study_field_id,
            ]);

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
        return view('livewire.studiekeuzes.add-studiekeuze');
    }
}
