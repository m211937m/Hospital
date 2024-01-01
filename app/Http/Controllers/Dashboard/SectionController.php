<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Sections\SectionInterface;
use Illuminate\Http\Request;


class SectionController extends Controller
{
    private $Sections;

    public function __construct(SectionInterface $Sections)
    {
        $this->Sections = $Sections;
    }

    public function index()
    {
        return $this->Sections->index();
    }

    public function store(Request $request)
    {
        return $this->Sections->store($request);
    }

    public function show($id)
    {
        return $this->Sections->show($id);
    }

    public function update(Request $request)
    {
        return $this->Sections->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Sections->destroy($request);
    }
}
