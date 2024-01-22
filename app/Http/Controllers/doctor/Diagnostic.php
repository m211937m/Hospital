<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\DiagnosisInterface;
use Illuminate\Http\Request;

class Diagnostic extends Controller

{
    private $Diagnostics;
    public function __construct(DiagnosisInterface $Diagnostics)
    {
        $this->Diagnostics = $Diagnostics;
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
        return $this->Diagnostics->store($request);
    }

    public function show($id)
    {
        return $this->Diagnostics->show($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
