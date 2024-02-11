<?php

namespace App\Http\Controllers\Lab_Emp;

use App\Http\Controllers\Controller;
use App\Interfaces\lab_emp_dashborad\InvoicesInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    private $invoise;
    public function __construct(InvoicesInterface $invoise)
    {
        $this->invoise = $invoise;
    }

    public function index()
    {
        return $this->invoise->index();
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        return $this->invoise->edit($id);
    }

    public function viewRays($id)
    {
        return $this->invoise->viewRays($id);
    }

    public function update(Request $request, $id)
    {
        return $this->invoise->update($request,$id);
    }

    public function destroy($id)
    {

    }

    public function complete_invoices()
    {
        return $this->invoise->complete_invoices();
    }
}
