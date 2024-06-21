<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requests ;
use App\Models\Doctor ;
use App\Models\Comment ;
use App\Models\Government ;
use App\Models\Clinic ;

use DB ;
use Auth ;

class DoctorController extends Controller
{
    public function index(){
        // price in table clinic  , sum of request = profit
        $doc_id = auth()->user()->id ;
        $count_requests = Requests::where('doctor_id' , $doc_id)->count() ;
        $price = DB::table('clinics')->where('doc_id' , $doc_id )->value('price') ;
        $profit = $price * $count_requests ;
        $count_comments = Comment::where('doctor_id' , $doc_id)->count() ;
        $requests = Requests::where('doctor_id', '=' , $doc_id)->paginate(7) ;
        $comments = Comment::where('doctor_id' , $doc_id)->paginate(7) ;

        return view('doctor.dashboard.index' , compact('count_requests' , 'count_comments' , 'profit' , 'requests' , 'comments'));
    }
    public function RequestsBooking()
    {
        $doctor_id = Auth::user()->id ;
        $requests = Requests::where('doctor_id', '=' , $doctor_id)->get() ;
        return view('doctor.MyRequests.index' , compact('requests'));
    }
    public function profile()
    {
        $doctor_id = Auth::user()->id ;
        $doctor = Doctor::find($doctor_id) ;
        $governments = Government::all() ;
        return view('doctor.profile.profile' , compact(['doctor' , 'governments'])) ;
    }

    // update profile
    public function update(Request $request , $id )
    {
        $validate = $request->validate([
            'phone' => 'required|min:11|max:11',
            'gov_id' => 'required',
            'bio_ar' => 'required|min:15',
            'bio_en' => 'required|min:15',
            'clinic_name_ar' => 'required',
            'clinic_name_en' => 'required',
            'clinic_price' => 'required',

        ]);
        $doctor = Doctor::find($id) ;
        $path_image = $doctor->image ;
        if ($request->image){
            $image = $request->file('image')->getClientOriginalName();
            $path_image = $request->file('image')->StoreAs('doctors' /*name folder*/,$image/*name of image */,'doctors' /*name disk in filesystem*/);
        }
        if($doctor){
            $doc = DB::table('doctors')->where('doctors.id' , $id)
                ->join('clinics' , 'clinics.doc_id' , '=' , 'doctors.id')
                ->update([
                    'doctors.phone' => $request->phone ,
                    'doctors.gov_id' => $request->gov_id ,
                    'doctors.bio' => [ 'ar' => $request->bio_ar , 'en' => $request->bio_en ],
                    'doctors.image' => $path_image ,
                    'clinics.name' => [ 'ar' => $request->clinic_name_ar , 'en' => $request->clinic_name_en ],
                    'clinics.price' => $request->clinic_price
                ]);
            return redirect()->back()->with(['success' => __(key:'site.updated_successfully')]);
        }
        return redirect()->back()->with(['success' => __(key:'site.no_data_found')]);

    }

    public function clinic()
    {
        $doc_id = auth()->user()->id ;
        $clinics = Clinic::where('doc_id' , $doc_id )->get() ;
        return view('doctor.clinic.clinic' , compact('clinics'));
    }
    public function storeClinic(Request $request)
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
            'address' => $request->address ,
            'price' => $request->price ,
            'doc_id' => auth()->user()->id ,
        ]);
        return redirect()->back()->with('success' , __('site.added_successfully')) ;
    }

}
