<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator ;
use Auth ;
use App\Models\Doctor ;
use App\Models\Government ;
use App\Models\Specialization ;
use App\Http\Requests\DoctorRequest ;
use Hash ;

class DocAuthController extends Controller
{
    public function login(){
        return view('doctor.auth.login') ;
    }
    public function Checklogin(Request $request)
    {
        $rules = ['email' => 'required|email' ,'password' => 'required|min:5'];
        $validator = Validator::make($request->all() , $rules);

        if($validator->fails()){
            return  redirect()->back()->withErrors($validator)->withInput($request->all);
        }else{
            if(Auth::guard('doctor')->attempt(['email' => $request->email, 'password' => $request->password , 'status' => 1])){
                return redirect()->route('doctor.dashboard');
            }
        }
    }
    public function register()
    {
        $governments = Government::all() ;
        $specialization = Specialization::all() ;
        return view('doctor.auth.register' , compact('governments' , 'specialization')) ;
    }
    public function CheckeRgister(Request $request)
    {
        // $validated = $request->validated(); // DoctorRequests
        $path_image = 'doctors/default.jpg' ;
        $path_verify = 'doctors/verifys' ;
        if ($request->image){
            $image = $request->file('image')->getClientOriginalName();
            $path_image = $request->file('image')->StoreAs('doctors' /*name folder*/,$image/*name of image */,'doctors' /*name disk in filesystem*/);
        }
        if($request->img_verify){
            $img_verify = $request->file('img_verify')->getClientOriginalName();
            $path_verify = $request->file('img_verify')->StoreAs('doctors' /*name folder*/,$img_verify/*name of image */,'doctors' /*name disk in filesystem*/);
        }

        Doctor::create([
            'name' => ['ar' => $request->name_ar , 'en' => $request->name_en],
            'bio' => ['ar' => $request->bio_ar , 'en' => $request->bio_en],
            'phone' => $request->phone,
            'email' => $request->email,
            'image' => $path_image ,
            'password' => Hash::make($request->password),
            'nid' => $request->nid ,
            'img_verify' => $path_verify ,
            'status' => 0 ,
            'gov_id' => $request->gov_id ,
            'special_id' => $request->special_id ,
        ]) ;
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('doctor.register') ;
    }

}
