<?php

namespace App\Interfaces\doctor_dashboard;

interface LaboratorieInterface
{
    public function store($requset);
    public function update($requset,$id);
    public function destroy($id);

}
