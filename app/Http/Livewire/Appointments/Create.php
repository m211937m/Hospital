<?php

namespace App\Http\Livewire\Appointments;

use App\Models\Appointmen;
use App\Models\Doctor;
use App\Models\Section;
use Livewire\Component;

class Create extends Component
{
    public $message = false;
    public $section ,$name ,$email ,$phone ,$notes ,$doctors ,$doctor;
    public function mount(){
        $this->doctors = [];
    }
    public function render()
    {
        $sections = Section::get();
        return view('livewire.appointments.create',compact('sections'));
    }
    public function get_doctor(){
        $this->doctors = Doctor::where('section_id',$this->section)->where("status",1)->orderBy("created_at","desc")->get();
    }
    public function store(){
        $appoienm = new Appointmen();
        $appoienm->doctor_id = $this->doctor;
        $appoienm->section_id = $this->section;
        $appoienm->name = $this->name;
        $appoienm->email = $this->email;
        $appoienm->phone = $this->phone;
        $appoienm->notes = $this->notes;
        $appoienm->type = 1;
        $appoienm->save();
        $this->message = true;
    }
}
