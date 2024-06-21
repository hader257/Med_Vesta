<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator ;
use Auth ;

class AdminAuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function Checklogin(Request $request)
    {
        // $rules = ['email' => 'required|email' ,'password' => 'required|min:5'];
        $validation = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        // $validator = Validator::make($request->all() , $rules);


        if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('admin.dashboard');
        }

    }
    public function logout()
    {
        //
    }

}
