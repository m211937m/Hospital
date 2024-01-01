<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Services\SingleServiceInterface;
use Illuminate\Http\Request;

class SingleServiceController extends Controller
{
    private $service;

    public function __construct(SingleServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }


    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function update(Request $request)
    {
        return $this->service->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->service->destroy($request);
    }
}
