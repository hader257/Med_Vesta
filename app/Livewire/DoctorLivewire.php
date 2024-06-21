<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Doctor ;
use App\Models\Specialization ;


class DoctorLivewire extends Component
{
    public $search ;
    public function render()
    {
        $doctors = [] ;
        $specialization = Specialization::all();
        if(! empty($this->search)){
            $doctors = Doctor::where('name' , 'like' , '%'. $this->search .'%')->where('status' , 1)->get() ;
        }else{
            // doctors id verify only
            $doctors = Doctor::where('status' , 1)->get() ;
        }
        return view('livewire.doctor-livewire' ,compact('doctors' , 'specialization'));
    }
}
