<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requests ;
use App\Traits\GeneralTrait ;
use Validator ;

class RequestsAppointmentController extends Controller
{
    use GeneralTrait ;
    // بفكر بموضع static ....

    // patient_id => it is authentication of user
    public function show($patient_id)
    {
        // Requests::find($patient_id);
        if(Requests::where('patient_id' , $patient_id)->exists())
        {
            $appointment = Requests::with('doctor:id,name,phone','patient:id,name as name_patient,phone')
            ->where('patient_id' , $patient_id)->get();
            return $this->getData('appointment' , $appointment) ;
        }else{
            return $this->SuccessApi('No any appointment to this person') ;
        }
    }

    public function store(Request $request)
    {
        $patient_id = Auth::guard('api')->user()->id ;
        $rules = [
            'date' => 'required|date' ,
            'oclock' => 'required',
            'doctor_id' => 'required|integer' ,
        ];
        $validator = Validator($request->all() , $rules) ;
        if($validator->fails()){
            return $this->ValidationError($validator->errors()) ;
        }
        Requests::create([
            'date' => $request->date,
            'oclock' => $request->oclock,
            'doctor_id' => $request->doc_id,
            'patient_id' => $patient_id
        ]);
        return $this->SuccessApi('Appointment is be booking');
    }

    public function update(Request $request , $request_id )
    {
        $patient_id = Auth::guard('api')->user()->id ;
        if(Requests::where('id' , $request_id )->exists()){
            $rules = [
                'date' => 'required|date' ,
                'oclock' => 'required',
                'doctor_id' => 'required|integer' ,
            ];
            $validator = Validator($request->all() , $rules) ;
            if($validator->fails()){
                return $this->ValidationError($validator->errors()) ;
            }
            $appointment = Requests::find($request_id) ;
            $appointment->updated([
                'date' => $request->date,
                'oclock' => $request->oclock,
                'doctor_id' => $request->doc_id,
                'patient_id' => $patient_id ,
            ]);
            return $this->SuccessApi('Appointment is be updated') ;
        }else{
            return $this->SuccessApi('Appointment is not exists') ;
        }
    }

    public function destroy($request_id)
    {
        if(Requests::where('id' , $id)->exists())
        {
            $appointment = Requests::find($request_id);
            $appointment->delete() ;
            return $this->SuccessApi('Appointment is be deleted') ;
        }else{
            return $this->SuccessApi('Appointment is not exists') ;
        }
    }
}
