<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Laboratorie_employee\Laboratorie_employeeInterface;
use Illuminate\Http\Request;

class LaboratorieEemployeeController extends Controller
{
    private $laboratorie_employee;
    public function __construct(Laboratorie_employeeInterface $laboratorie_employee){
        $this->laboratorie_employee = $laboratorie_employee;
    }
    public function index()
    {
        return $this->laboratorie_employee->index();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->laboratorie_employee->store($request);
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
        return $this->laboratorie_employee->update($request,$id);
    }

    public function destroy($id)
    {
        return $this->laboratorie_employee->destroy($id);
    }
}
