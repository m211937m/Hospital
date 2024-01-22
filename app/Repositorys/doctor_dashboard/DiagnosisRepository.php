<?Php

namespace App\Repositorys\doctor_dashboard;

use App\Interfaces\doctor_dashboard\DiagnosisInterface;
use App\Models\Diagnosis;
use App\Models\DiagnosisTranslation;
use App\Models\Diagnostic;
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

            $patient_records = Diagnostic::where('patient_id',$id)->where('doctor_id',Auth::user()->id)->get();
            return view('Dashboard.doctor.invoice.patient_record',compact('patient_records'));

        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }






}
