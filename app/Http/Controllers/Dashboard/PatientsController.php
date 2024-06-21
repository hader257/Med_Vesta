<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient ;
use App\Models\Government ;
use Validator ;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all() ;
        $governments = Government::all() ;
        return view('admin.patients.index' , compact('patients' , 'governments')) ;
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
        $rules = ['name' => 'required|min:8' , 'email' => 'required|email|unique:patients,email' , 'password' => 'required|min:8' , 'phone' => 'required|min:11|max:11' , 'address' => 'required','gov_id' => 'required' ];
        $validated = Validator::make($request->all() , $rules) ;
        if($validated->fails()){
            return redirect()->back()->withErrors($validated)->withInput($request->all) ;
        }
        Patient::create($request->all());
        return redirect()->back()->with('success' , __('site.added_successfully')) ;
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
    public function update(Request $request, $id)
    {
        $patient = Patient::find($id) ;
        if($patient->count() > 0 ){
            $rules = ['name' => 'required|min:8' , 'email' => 'required|email|unique:patients,email' , 'password' => 'required|min:8' , 'phone' => 'required|min:11|max:11' , 'address' => 'required' , 'gov_id' => 'required' ];
            $validated = Validator::make($request->all() , $rules) ;
            if($validated->fails()){
                return redirect()->back()->withErrors($validated)->withInput($request->all) ;
            }
            $patient->update($request->all());
            return redirect()->back()->with('success' , __('site.updated_successfully')) ;
        }else{
            return redirect()->back()->with('success' , __('site.no_data_found')) ;
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $patient = Patient::find($id) ;
        if($patient->exists()){
            $patient->delete() ;
            return redirect()->back()->with('success' , __(key:'site.deleted_successfully')) ;
        }else{
            return redirect()->back()->with('success' , __(key:'site.no_data_found'));
        }
    }
}
