<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\LaboratorieInterface;
use Illuminate\Http\Request;

class LaboratorieController extends Controller
{
    private $Laboratorie;
    public function __construct(LaboratorieInterface $Laboratorie)
    {
        $this->Laboratorie = $Laboratorie ;
    }

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
       return  $this->Laboratorie->store($request);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        return  $this->Laboratorie->update($request,$id);
    }

    public function destroy($id)
    {
        return  $this->Laboratorie->destroy($id);
    }
}
