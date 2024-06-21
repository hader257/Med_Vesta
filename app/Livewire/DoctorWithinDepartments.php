<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Specialization ;
use App\Models\Doctor ;


class DoctorWithinDepartments extends Component
{
    public $specialization_id ;
    public $nameSpecialization ;
    public $doctors ;

    public function loadDoctors($special_id)
    {
        $this->specialization_id = $special_id ;
        $name = Specialization::where('id',$special_id)->first() ;
        $this->nameSpecialization = $name->name ;
        $this->doctors = Doctor::where([
            ['special_id' , $this->specialization_id],
            ['status' , 1]
            ])->get();
    }
    public function render()
    {
        return view('livewire.doctor-within-departments',
            ['specialization' => Specialization::all()]);
    }
}
