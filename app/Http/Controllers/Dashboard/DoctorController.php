<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Doctors\DoctorInterface;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    private $Doctors;

    public function __construct(DoctorInterface $Doctors)
    {
        $this->Doctors = $Doctors;
    }
    public function index()
    {
        return $this->Doctors->index();
    }


    public function create()
    {
        return $this->Doctors->create();
    }


    public function store(Request $request)
    {
        return $this->Doctors->store($request);
    }

    public function edit($id)
    {
        return $this->Doctors->edit($id);
    }

    public function update(Request $request)
    {
        return $this->Doctors->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Doctors->destroy($request);
    }

    public function update_password(Request $request){

        $this->validate($request,[
            'password' => ['required','min:8','confirmed'],
            'password_confirmation' => ['required','min:8'],
        ]);

        return $this->Doctors->update_password($request);
    }
    public function status(Request $request)
    {
        $request->validate([
            "status" => ['required','in:0,1'],
        ]);
        return $this->Doctors->status($request);
    }
}
