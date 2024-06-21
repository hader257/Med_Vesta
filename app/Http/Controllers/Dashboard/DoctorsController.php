<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor ;
use App\Models\Government ;
use App\Models\Clinic ;
use App\Models\Specialization ;
use App\Http\Requests\DoctorRequest ;
use Hash ;
use DB ;
use App\Mail\VerfiyDoctors ;
use App\Mail\BlockDoctors ;



class DoctorsController extends Controller
{

/**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $doctors = $request->search ?
            Doctor::where('name' , 'like' ,'%'.$request->search.'%')
            ->orWhere('phone' ,  'like' ,'%'.$request->search.'%')
            ->orWhere('email' ,  'like' ,'%'.$request->search.'%')->get()
            : Doctor::orderBy('id' , 'desc')->get() ;

        return view('admin.Doctors.index' , compact('doctors')) ;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clinics = Clinic::all() ;
        $specialization = Specialization::all() ;
        $governments = Government::all() ;
        return view('admin.doctors.create' , compact('clinics','specialization','governments')) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorRequest $request)
    {
        $validated = $request->validated(); // DoctorRequests
        $path_image = 'doctors/default.jpg' ;
        if ($request->image){
            $image = $request->file('image')->getClientOriginalName();
            $path_image = $request->file('image')->StoreAs('doctors' /*name folder*/,$image/*name of image */,'doctors' /*name disk in filesystem*/);
        }
        Doctor::create([
            'name' => ['ar' => $request->name_ar , 'en' => $request->name_en],
            'bio' => ['ar' => $request->bio_ar , 'en' => $request->bio_en],
            'phone' => $request->phone,
            'email' => $request->email ,
            'image' => $path_image ,
            'password' => Hash::make($request->password) ,
            'nid' => $request->nid ,
            'img_verify' => 'doctor/verify.png' ,
            'status' => 0 ,
            'gov_id' => $request->government_id ,
            'special_id' => $request->special_id ,
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
    public function edit($id)
    {
        $clinics = Clinic::all() ;
        $specialization = Specialization::all() ;
        $governments = Government::all() ;
        $doctor = Doctor::find($id) ;
        return view('admin.doctors.edit' , compact('doctor','clinics' , 'specialization' , 'governments')) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorRequest $request, $id)
    {
        $doctor = Doctor::find($id) ;
        if($doctor->count() > 0 ){
            $validated = $request->validated();
            $doctor->update([
                'name' => ['ar' => $request->name_ar , 'en' => $request->name_en],
                'bio' => ['ar' => $request->bio_ar , 'en' => $request->bio_en],
                'phone' => $request->phone,
                'email' => $request->email  ,
                'password' => Hash::make($request->password),
                'nid' => $request->nid ,
                'status' => $request->status ,
                'gov_id' => $request->government_id ,
                'special_id' => $request->special_id ,
            ]);


            return redirect()->back()->with('success' , __(key:'site.updated_successfully')) ;
        }else{
            return redirect()->back()->with('success' , __(key:'site.no_data_found'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $doctor = Doctor::find($id) ;
        if($doctor->exists()){
            $doctor->delete() ;
            return redirect()->back()->with('success' , __(key:'site.deleted_successfully')) ;
        }else{
            return redirect()->back()->with('success' , __(key:'site.no_data_found'));
        }
    }

    // 0 => new , 1 => verify , 2 => block
    public function verify(Request $request)
    {
        $doctor = Doctor::find($request->id);
        if($doctor->exists())
        {
            DB::table('doctors')->where('id' , $request->id)->update(['status' => 1]);
            Mail::to('abdelrahimmahmoud6@gmail.com')->send(new VerfiyDoctors($doctor)) ;
            return redirect()->back()->with('success' ,__(key:'site.updated_successfully'));
        }
        else{
            return  redirect()->back()->with('success' , __(key:'site.no_data_found'));
        }
    }

    public function block(Request $request )
    {
        $doctor = Doctor::find($request->id);
        if($doctor->exists()){
            DB::table('doctors')->where('id' , $request->id)->update(['status' => 2]);
            Mail::to('abdelrahimmahmoud6@gmail.com')->send(new BlockDoctors($doctor));
            return redirect()->back()->with('success' ,__(key:'site.updated_successfully'));
        }
        else{
            return  redirect()->back()->with('success' , __(key:'site.no_data_found'));
        }
    }


}
