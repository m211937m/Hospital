<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\RayInterface;
use Illuminate\Http\Request;

class Raycontroller extends Controller
{

    private $Ray;
    public function __construct(RayInterface $Ray)
    {
        $this->Ray = $Ray;
    }
    public function store(Request $request)
    {
       return $this->Ray->store($request);
    }

    public function update(Request $request,$id)
    {
        return $this->Ray->update($request,$id);
    }

    public function destroy($id)
    {
        return $this->Ray->destroy($id);
    }
}
