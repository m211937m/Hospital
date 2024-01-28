<?php

namespace App\Interfaces\Ray_employee;

interface Ray_employeeInterface
{
    public function index();
    public function store($request);
    public function update($request,$id);
    public function destroy($id);

}
