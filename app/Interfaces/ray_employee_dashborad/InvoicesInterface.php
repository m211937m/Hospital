<?php

namespace App\Interfaces\ray_employee_dashborad;

interface InvoicesInterface
{

    public function index();
    public function complete_invoices();
    public function edit($id);
    public function viewRays($id);
    public function update($request,$id);

}
