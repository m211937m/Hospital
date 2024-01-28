<?Php

namespace App\Repositorys\doctor_dashboard;

use App\Interfaces\doctor_dashboard\DiagnosisInterface;
use App\Models\Diagnosis;
use App\Models\DiagnosisTranslation;
use App\Models\Diagnostic;
use App\Models\Invoice;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class DiagnosisRepository implements DiagnosisInterface
{

    public function store($request)
    {
        DB::beginTransaction();
        try{
            $this->update_invoice_status($request->invoice_id , 3);
            $Diagnostics = new Diagnostic();
            $Diagnostics->date = date('Y-m-d');
            $Diagnostics->doctor_id = $request->doctor_id;
            $Diagnostics->patient_id = $request->patient_id;
            $Diagnostics->invoice_id = $request->invoice_id;
            $Diagnostics->save();

            $Diagnostics->diagnostic = $request->diagnosis ;
            $Diagnostics->medicine = $request->medicine ;

            $Diagnostics->save();

            DB::commit();
            session()->flash("add");
            return redirect()->route('invoice.index');


        }

        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try{

            $patient_records = Diagnostic::where('patient_id',$id)->get();
            return view('Dashboard.doctor.invoice.patient_record',compact('patient_records'));

        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function add_review($request)
    {
        DB::beginTransaction();
        try{

            $this->update_invoice_status($request->invoice_id , 2);
            $Diagnostics = new Diagnostic();
            $Diagnostics->date = date('Y-m-d');
            $Diagnostics->review_date = $request->review_date;
            $Diagnostics->doctor_id = $request->doctor_id;
            $Diagnostics->patient_id = $request->patient_id;
            $Diagnostics->invoice_id = $request->invoice_id;
            $Diagnostics->save();

            $Diagnostics->diagnostic = $request->diagnosis ;
            $Diagnostics->medicine = $request->medicine ;

            $Diagnostics->save();

            DB::commit();
            session()->flash("add");
            return redirect()->route('invoice.index');


        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }



    public function update_invoice_status($invoice_id,$status){

        $invoice_status = Invoice::findorfail($invoice_id);
            $invoice_status->invoice_status = $status;
            $invoice_status->save();
    }


}
