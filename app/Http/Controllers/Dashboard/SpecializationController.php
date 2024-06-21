<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specialization ;
use DB ;
class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $specialization = $request->search ?
            Specialization::where('name' , 'like' ,'%'.$request->search.'%')->get()
            : Specialization::all() ;

            return view('admin.specializations.index' , compact('specialization')) ;

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
        ],[
            'name_ar.required' => __('validation.name_ar_required') ,
            'name_en.required' => __('validation.name_en_required') ,
            'name_ar.min' => __('validation.name_ar_min') ,
            'name_ar.min' => __('validation.name_en_min') ,
        ]);
        Specialization::create([
            'name' => [
                'ar' => $request->name_ar ,
                'en' => $request->name_en
            ]
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
        $special = Specialization::find($id) ;
            $validated = $request->validate([
                'name_ar' => 'required|min:8',
                'name_en' => 'required|min:8',
            ],[
                'name_ar.required' => __('validation.name_ar_required') ,
                'name_en.required' => __('validation.name_en_required') ,
                'name_ar.min' => __('validation.name_ar_min') ,
                'name_ar.min' => __('validation.name_en_min') ,
            ]);
            $special->update(['name' => ['ar'=>$request->name_ar , 'en' => $request->name_en]]);
            return redirect()->back()->with('success' , __(key:'site.updated_successfully')) ;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $special = Specialization::find($id) ;
        if($special->exists()){
            $special->delete() ;
            return redirect()->back()->with('success' , __(key:'site.deleted_successfully')) ;
        }else{
            return redirect()->back()->with('success' , __(key:'site.no_data_found'));
        }
    }
}
