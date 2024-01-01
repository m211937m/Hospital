<?php

namespace App\Interfaces\Services;

interface SingleServiceInterface
{
    public function index();
    public function store($request);
    public function destroy($request);
    public function update($request);
}
