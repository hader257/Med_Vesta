<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait ;
use DB ;
use App\Models\Doctor ;
use App\Models\Government ;
use App\Models\Specialization ;

use makeHidden ;


class ApiController extends Controller
{
    use GeneralTrait ;

    // standard search
    public function querySearch($NameTable , $NameItemFromDB , $request)
    {
        if($NameTable == 'doctors'){
            return Doctor::where($NameItemFromDB , 'like' , '%'. $request . '%')->get() ;
        }
        elseif($NameTable == 'governments'){
            return Government::where($NameItemFromDB , 'like' , '%'. $request . '%')
            ->select('name')->get() ;
        }
        elseif($NameTable == 'specialization'){
            return Specialization::where($NameItemFromDB , 'like' , '%'. $request . '%')
            ->select('name')->get();
        }else{
            return $this->ErrorApi('no data found');
        }
    }

    //=============== Doctors Api===============
    // get all doctors
    public function getAllDoctors()
    {
        $allDoctors = Doctor::with(['clinic:id,name,price' ,'government:id,name' , 'special:id,name'])->get();
        return $this->getData('doctors' , $allDoctors);
    }
    // get doctor
    public function getDoctor($id)
    {
        if(Doctor::where('id' , $id)->exists()){
            // $doctor = Doctor::find($id);
            $doctor = Doctor::where('id' , $id)->with('clinic:id,name,price','special:id,name')->get();
            return $this->getData('Doctor' , $doctor);
        }else{
            return $this->ErrorApi('No data found') ;
        }
    }

    // search doctor from within your name
    public function searchDoctors($name)
    {
        $search = $this->querySearch('doctors' , 'name' , $name);
        if($search->count() > 0 ){
            return $this->getData('Doctors' , $search) ;
        }else{
            return $this->SuccessApi('No data found') ;
        }
    }

    // search doctors from within governments
    public function searchDoctorWithinGovernment($name)
    {
        $search = DB::table('doctors')->join('governments' , 'doctors.gov_id' , '=' , 'governments.id')
        ->join('clinics' , 'clinics.doc_id' , '=' , 'doctors.id')
        ->select('doctors.name as name_doc','doctors.rate' , 'doctors.bio','clinics.price','governments.name as gov_name')
        ->where('governments.name' , 'like' , '%'. $name . '%')->get();
        if($search->count() > 0 ){
            return $this->getData('Doctors' , $search) ;
        }else{
            return $this->SuccessApi('No data found') ;
        }
    }

    // search doctors within specialization
    public function searchDoctorsWithinSpecial($name)
    {
        $search = Doctor::join('specializations' , 'doctors.special_id' , '=' , 'specializations.id')
        ->join('clinics' , 'doctors.id' , '=' , 'clinics.doc_id')
        ->where('specializations.name' , 'like' , '%'.$name.'%')
        ->select('doctors.name as name_doc' , 'doctors.rate' , 'doctors.bio' , 'clinics.price')->get();
        if($search->count() > 0 ){
            return $this->getData('Doctors' , $search) ;
        }else{
            return $this->SuccessApi('No data found') ;
        }
    }

    // =======Government Api========

    // get all governments
    public function getAllGovernments()
    {
        $allAreas = Government::select('name')->get();
        if($allAreas->count() > 0 ){
            return $this->getData('Doctors' , $allAreas) ;
        }else{
            return $this->SuccessApi('No data found') ;
        }
    }

    // search governments
    public function searchGovernment($name)
    {
        $government = $this->querySearch('governments' ,'name' , $name);
        if($government->count() > 0 ){
            return $this->getData('government' , $government) ;
        }else{
            return $this->SuccessApi('No data found') ;
        }
    }

    // get all specialization
    public function getAllSpecialization()
    {
        $allSpecial = Specialization::select('name')->get();
        return $this->getData('specialization' , $allSpecial) ;
    }

    // serach specialization
    public function searchSpecialization($name)
    {
        $special = $this->querySearch('specialization' , 'name' , $name) ;
        if($special->count() > 0 ){
            return $this->getData('specialization' , $special );
        }else{
            return $this->SuccessApi('No Data found');
        }
    }

}
