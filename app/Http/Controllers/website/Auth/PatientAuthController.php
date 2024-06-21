<?php

namespace App\Http\Controllers\website\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Government ;
use App\Models\Patient ;
use Validator , Auth ;

class PatientAuthController extends Controller
{
    public function register()
    {
        $governments = Government::all() ;
        return view('website.auth.register' , compact('governments')) ;
    }

    public function registerStore(Request $request)
    {
        $rules = ['name' => 'required|min:8' , 'email' => 'required|email|unique:patients,email' , 'password' => 'required|min:8' , 'phone' => 'required|min:11|max:11' ,'address' => 'required' , 'gov_id' => 'required' ];
        $validated = Validator::make($request->all() , $rules) ;
        if($validated->fails()){
            return redirect()->back()->withErrors($validated)->withInput($request->all) ;
        }
        Patient::create($request->all());
        return redirect()->back()->with('success' , __('site.added_successfully')) ;
    }

    public function login()
    {
        return view('website.auth.login');
    }
    public function checkLogin(Request $request)
    {
        $rules = ['email' => 'required|email' ,'password' => 'required|min:5'];
        $validator = Validator::make($request->all() , $rules);

        if($validator->fails()){
            return  redirect()->back()->withErrors($validator)->withInput($request->all);
        }else{
            if(Auth::guard('patient')->attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('site.home');
            }
        }
    }

    public function logout()
    {
        auth()->logout() ;
        return redirect('/') ;
    }
}
