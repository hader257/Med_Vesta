<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Government\GovernmentRepositoryInterface;
use App\Repository\Government\GovernmentRepository;
use App\Models\Government ;


class GovernmentController extends Controller
{
    private $governments ;

    public function __construct(GovernmentRepositoryInterface $governments)
    {
        $this->governments = $governments ;
    }

    public function index(Request $request)
    {
        return $this->governments->index($request) ;
    }

    public function store(Request $request)
    {
        return $this->governments->store($request) ;
    }

    public function update(Request $request, $id)
    {
        return $this->governments->update($request , $id) ;
    }

    public function destroy($id)
    {
        return $this->governments->destroy($id) ;
    }
}
