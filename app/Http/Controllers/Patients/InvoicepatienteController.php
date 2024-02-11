<?php

namespace App\Http\Controllers\Patients;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Laboratorie;
use App\Models\Ray;
use Exception;
use Illuminate\Http\Request;

class InvoicepatienteController extends Controller
{

    public function invoice()
    {
        try{
            $invoices = Invoice::where('patient_id',auth()->user()->id)->get();
            return view('Dashboard.dashborad_patients.invoices',compact('invoices'));
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['erroe' => $e->getMessage()]);
        }
    }

    public function Laboratorie()
    {

        try{
            $laboratories = Laboratorie::where('patient_id',auth()->user()->id)->get();
            return view('Dashboard.dashborad_patients.laboratories',compact('laboratories'));
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['erroe' => $e->getMessage()]);
        }
    }

    public function Ray()
    {
        try{
            $rays  = Ray::where('patient_id',auth()->user()->id)->get();
            return view('Dashboard.dashborad_patients.rays',compact('rays'));
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['erroe' => $e->getMessage()]);
        }

    }
}
