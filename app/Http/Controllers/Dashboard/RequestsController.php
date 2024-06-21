<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requests ;

class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = Requests::all() ;
        return view('admin.requests.index' , compact('requests')) ;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $requests =  Requests::find($id) ;
        return view('admin.requests.show' , compact('request'));
    }

}
