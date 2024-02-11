<?php

namespace App\Interfaces\doctor_dashboard;

interface InvoicesInterface
{

    public function index();

    public function show($id);

    public function reviewInvoices();

    public function completeInvoice();

}
