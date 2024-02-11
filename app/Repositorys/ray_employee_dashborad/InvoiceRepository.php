<?Php

namespace App\Repositorys\ray_employee_dashborad;

use App\Interfaces\ray_employee_dashborad\InvoicesInterface;
use App\Models\Invoice;
use App\Models\Ray;
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

            $rays = Ray::where('case',0)->get();
            return view('Dashboard.dashboard_RayEmployee.invoices.index' ,compact('rays'));
        }

        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function complete_invoices(){

        try{

            $invoices = Ray::where('case',1)->where('ray_employee_id',auth()->user()->id)->get();
            return view('Dashboard.dashboard_RayEmployee.invoices.completed_invoices' ,compact('invoices'));
        }

        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id){

        try{

            $invoice = Ray::findorfail($id);
            return view('Dashboard.dashboard_RayEmployee.invoices.add_diagnosis' ,compact('invoice'));
        }

        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function viewRays($id){

            $rays = Ray::findorfail($id);
            if($rays->ray_employee_id == auth()->user()->id)
            {return view('Dashboard.dashboard_RayEmployee.invoices.patient_details' ,compact('rays'));}
            else
            {return view('Dashboard.404');}

    }
    public function update($request,$id){

        try{

            DB::beginTransaction();
            $Ray = Ray::findorfail($id);
            $Ray->ray_employee_id = Auth::user()->id;
            $Ray->case =1;
            $Ray->save();

            $Ray->descriptio_employee = $request->description_employee;
            $Ray->save();
            if($request->hasFile('photos')){
                foreach($request->photos as $photo){

                    $this->verifyAndStoreImageForeach($photo,'Rays','upload_image',$Ray->id,'App\Models\Ray');
                }
            }
            DB::commit();
            session()->flash('add');
            return redirect()->route('invoices_ray_employee.index');
        }

        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
