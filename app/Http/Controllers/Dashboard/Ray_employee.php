<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Ray_employee\Ray_employeeInterface;
use Illuminate\Http\Request;

class Ray_employee extends Controller
{
    private $Employee;
    public function __construct(Ray_employeeInterface $Employee)
    {
        $this->Employee = $Employee ;
    }

    public function index()
    {
        return $this->Employee->index();
    }

    public function store(Request $request)
    {
        return $this->Employee->store($request);
    }

    public function update(Request $request, $id)
    {
        return $this->Employee->update($request,$id);
    }

    public function destroy($id)
    {
        return $this->Employee->destroy($id);
    }
}
