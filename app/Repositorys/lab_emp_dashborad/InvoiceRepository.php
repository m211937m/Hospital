<?Php

namespace App\Repositorys\lab_emp_dashborad;

use App\Interfaces\lab_emp_dashborad\InvoicesInterface;
use App\Models\Laboratorie;
use App\Traits\UploadTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceRepository implements InvoicesInterface
{
    use UploadTrait;
    // قائمة الكشوفات تحت الأجراء
    public function index(){

        try{

            $invoices = Laboratorie::where('case',0)->get();
            return view('Dashboard.dashboard_Lab_emp.invoices.index' ,compact('invoices'));
        }

        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function complete_invoices(){

        try{

            $invoices = Laboratorie::where('case',1)->where('lab_emp_id',auth()->user()->id)->get();
            return view('Dashboard.dashboard_Lab_emp.invoices.completed_invoices' ,compact('invoices'));
        }

        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id){

        try{

            $invoice = Laboratorie::findorfail($id);
            return view('Dashboard.dashboard_Lab_emp.invoices.add_diagnosis' ,compact('invoice'));
        }

        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function viewRays($id){

            $laboratorie = Laboratorie::findorfail($id);
            if($laboratorie->lab_emp_id == auth()->user()->id)
            {return view('Dashboard.dashboard_Lab_emp.invoices.patient_details' ,compact('laboratorie'));}
            else
            {return view('Dashboard.404');}

    }
    public function update($request,$id){

        try{

            DB::beginTransaction();
            $Ray = Laboratorie::findorfail($id);
            $Ray->lab_emp_id = Auth::user()->id;
            $Ray->case =1;
            $Ray->save();

            $Ray->descriptio_employee = $request->description_employee;
            $Ray->save();
            if($request->hasFile('photos')){
                foreach($request->photos as $photo){

                    $this->verifyAndStoreImageForeach($photo,'Laboratories','upload_image',$Ray->id,'App\Models\Laboratorie');
                }
            }
            DB::commit();
            session()->flash('add');
            return redirect()->route('invoices_lab_emp.index');
        }

        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
