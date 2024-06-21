<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait ;
use App\Models\Patient ;
use Auth , Validator;
use Tymon\JWTAuth\Facades\JWTAuth ;

class AuthController extends Controller
{
    use GeneralTrait ;
    public function login(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // login process
        $credentials = $request->only('email', 'password');
        $token = Auth::guard('api')->attempt($credentials) ;
        if(! $token){
            return response()->json(['msg' => 'Your data is not correct']) ;
        }
        $patient = Auth::guard('api')->user();
        $patient->token = $token ; // store token with your retrive data
        return response()->json([
            'status' => 200 ,
            'patient' => $patient
        ]);
    }

    public function register(Request $request) {
        $validator = Validator::make(
            $request->all(), [
            'name' => 'required|string|min:5',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'phone' => 'required|numeric',
            'address' => 'required|string|min:10',
            'gov_id' => 'required|numeric',

        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = Patient::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    public function logout() {

        $token = JWTAuth::getToken();
        if($token){
            JWTAuth::parseToken($token)->invalidate();
            return $this->SuccessApi("Logout successfully") ;
        }
        return $this->ErrorApi('Token is invalidate already or not exists') ;

    }
}
