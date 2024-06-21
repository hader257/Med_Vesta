<?php

namespace App\Repository\Government ;
use Illuminate\Database\Eloquent\Model;
use App\Interfaces\Government\GovernmentRepositoryInterface;
use App\Models\Government ;


class GovernmentRepository implements GovernmentRepositoryInterface
{

    public function index($request)
    {
        $governments = $request->search ?
            Government::where('name' , 'like' ,'%'.$request->search.'%')->get()
            : Government::all() ;

            return view('admin.government.index' , compact('governments')) ;
        // return "hello" ;
    }

    public function store($request)
    {
        $validated =$request->validate([
            'name_ar' => 'required|min:4' ,
            'name_en' => 'required|min:4' ,
        ],[
            'name_ar.required' => __('validation.name_ar_required') ,
            'name_en.required' => __('validation.name_en_required') ,
            'name_ar.min' => __('validation.name_ar_min') ,
            'name_ar.min' => __('validation.name_en_min') ,
        ]);
        Government::create([
            'name' => [
                'ar' => $request->name_ar ,
                'en' => $request->name_en
            ]
        ]);
        return redirect()->back()->with('success' , __('site.added_successfully')) ;
    }

    public function update($request, $id)
    {
        $government = Government::find($id) ;
            $validated = $request->validate([
                'name_ar' => 'required|min:4',
                'name_en' => 'required|min:4',
            ],[
                'name_ar.required' => __('validation.name_ar_required') ,
                'name_en.required' => __('validation.name_en_required') ,
                'name_ar.min' => __('validation.name_ar_min') ,
                'name_ar.min' => __('validation.name_en_min') ,
            ]);
            $government->update(['name' => ['ar'=>$request->name_ar , 'en' => $request->name_en]]);
            return redirect()->back()->with('success' , __(key:'site.updated_successfully')) ;

    }


    public function destroy($id)
    {
        $government = Government::find($id) ;
        if($government->exists()){
            $government->delete() ;
            return redirect()->back()->with('success' , __(key:'site.deleted_successfully')) ;
        }else{
            return redirect()->back()->with('success' , __(key:'site.no_data_found'));
        }
    }
}
