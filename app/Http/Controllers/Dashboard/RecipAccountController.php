<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Finance\ReceiptRepositoryInterface;
use Illuminate\Http\Request;

class RecipAccountController extends Controller
{
    private $RecipAccount ;
    public function __construct(ReceiptRepositoryInterface $RecipAccount)
    {
        $this->RecipAccount = $RecipAccount ;
    }

    public function index()
    {
       return $this->RecipAccount->index();
    }

    public function create()
    {
        return $this->RecipAccount->create();
    }

    public function store(Request $request)
    {
        return $this->RecipAccount->store($request);
    }

    public function show($id)
    {
        return $this->RecipAccount->show($id);
    }

    public function edit($id)
    {
        return $this->RecipAccount->edit($id);
    }

    public function update(Request $request)
    {
        return $this->RecipAccount->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->RecipAccount->destroy($request);
    }
}
