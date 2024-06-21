<?php

namespace App\Interfaces\Government;

interface GovernmentRepositoryInterface
{
    public function index($request) ;
    public function store($request) ;
    public function update($request , $id) ;
    public function destroy($id) ;
}
