<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clinic ;
use App\Models\Doctor ;


class ClinicsController extends Controller
{

   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clinics = $request->search ? Clinic::where('name' , 'like' , '%'.$request->search.'%')
            ->orWhere('price' , 'like' , '%'. $request->search , '%')->get() :
        Clinic::all() ;
        $doctors = Doctor::all() ;
        return view('admin.clinics.index' , compact('clinics' , 'doctors')) ;
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
        $validated =$request->validate([
            'name_ar' => 'required|min:8' ,
            'name_en' => 'required|min:8' ,
            'price' => 'required|numeric',
        ],[
            'name_ar.required' => __('validation.name_ar_required') ,
            'name_en.required' => __('validation.name_en_required') ,
            'name_ar.min' => __('validation.name_ar_min') ,
            'name_ar.min' => __('validation.name_en_min') ,
        ]);
        Clinic::create([
            'name' => [
                'ar' => $request->name_ar ,
                'en' => $request->name_en
            ],
            'address' => $request->address,
            'price' => $request->price ,
            'doc_id' => $request->doc_id ,
        ]);
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
        $clinic = Clinic::find($id) ;
            $validated = $request->validate([
                'name_ar' => 'required|min:8',
                'name_en' => 'required|min:8',
                'price' => 'required|numeric',
            ],[
                'name_ar.required' => __('validation.name_ar_required') ,
                'name_en.required' => __('validation.name_en_required') ,
                'name_ar.min' => __('validation.name_ar_min') ,
                'name_ar.min' => __('validation.name_en_min') ,
            ]);
            $clinic->update(['name' => ['ar'=>$request->name_ar , 'en' => $request->name_en] , 'price' => $request->price]);
            return redirect()->back()->with('success' , __(key:'site.updated_successfully')) ;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $clinic = Clinic::find($id) ;
        if($clinic->exists()){
            $clinic->delete() ;
            return redirect()->back()->with('success' , __(key:'site.deleted_successfully')) ;
        }else{
            return redirect()->back()->with('success' , __(key:'site.no_data_found'));
        }
    }
}
