<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment ;
use Validator ;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctor_id = Auth()->user()->id ;
        $days = Appointment::pluck('days' , 'id');
        $appointments = Appointment::where('doctor_id' , '=' , $doctor_id)->get() ;
        return view('doctor.MyAppointment.index' , compact('appointments' , 'days'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = ['days' => 'required' , 'Start_at' => 'required' , 'End_at' => 'required'];
        $validated = Validator::make($request->all() , $rules);
        if($validated->fails()){
            return redirect()->back()->withErrors($validated);
        }
        Appointment::create([
            'days' => $request->days ,
            'Start_at' => $request->Start_at,
            'End_at' => $request->End_at ,
            'doctor_id' => Auth()->user()->id
        ]);
        return redirect()->back()->with(__('site.added_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , $id )
    {
        $rules = ['days' => 'required' , 'Start_at' => 'required' , 'End_at' => 'required'];
        $validated = Validator::make($request->all() , $rules);
        if($validated->fails()){
            return redirect()->back()->withErrors($validated);
        }
        $appointment = Appointment::find($id);
        if(! $appointment->exists()){
            return redirect()->back()->with(__('site.no_data_found'));
        }
        $appointment->update([
            'days' => $request->days ,
            'Start_at' => $request->Start_at,
            'End_at' => $request->End_at ,
            'doctor_id' => Auth()->user()->id
        ]);
        return redirect()->back()->with(__('site.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        if(! $appointment){
            return redirect()->back()->with(__('site.no_data_found'));
        }
        $appointment->delete() ;
        return redirect()->back()->with(__('site.deleted_successfully'));
    }
}
