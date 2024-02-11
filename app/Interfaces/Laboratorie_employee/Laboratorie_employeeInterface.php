<?php

namespace App\Interfaces\Laboratorie_employee;

interface Laboratorie_employeeInterface
{
    public function index();
    public function store($request);
    public function update($request,$id);
    public function destroy($request);
}
