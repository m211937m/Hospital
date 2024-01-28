<?php

namespace App\Interfaces\doctor_dashboard;

interface DiagnosisInterface
{

    public function store($request);
    public function show($id);
    public function add_review($request);

}
