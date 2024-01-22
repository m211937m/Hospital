<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\InvoicesInterface;
use Illuminate\Http\Request;

class InvoiceContoller extends Controller
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
        //
    }


    public function store(Request $request)
    {
        //
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
        //
    }


    public function destroy($id)
    {
        //
    }
}
