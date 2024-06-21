<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor ;
use App\Models\Patient ;
use App\Models\Clinic ;
use App\Models\Specialization ;
use App\Models\Government ;
use App\Models\Requests ;
use DB ;


class DashboardController extends Controller
{
    public function index(){
        $patients = Patient::all();
        $doctors  = Doctor::all();
        $requests = Requests::all();
        $doctors_latest_7 = Doctor::orderBy('id' , 'desc')->paginate(7) ;
        $patients_latest_7 = Patient::orderBy('id' , 'desc')->paginate(7) ;

        // $total =
        // $profit = DB::table('appointments')->sum('price') ;
        return view('admin.dashboard.index' , compact('patients' , 'doctors' , 'requests' , 'doctors_latest_7','patients_latest_7')) ;
    }
}
