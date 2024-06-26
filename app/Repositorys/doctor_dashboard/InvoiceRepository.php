<?Php

namespace App\Repositorys\doctor_dashboard;

use App\Interfaces\doctor_dashboard\InvoicesInterface;
use App\Models\Invoice;
use App\Models\Ray;
use Exception;
use Illuminate\Support\Facades\Auth;

class InvoiceRepository implements InvoicesInterface
{
    // قائمة الكشوفات تحت الأجراء
    public function index(){

        try{

            $invoices = Invoice::where('doctor_id',Auth::user()->id)->where('invoice_status',1)->get();
            return view('Dashboard.doctor.invoice.index' ,compact('invoices'));
        }

        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function show($id){

           $rays = Ray::findorfail($id);
            if($rays->doctor_id == auth()->user()->id)
                {return view('Dashboard.doctor.invoice.view_rays',compact('rays'));}
            else
            {return view('Dashboard.404');}


    }
    //قائمة المراجعات
    public function reviewInvoices(){

        try{

            $invoices = Invoice::where('doctor_id',Auth::user()->id)->where('invoice_status',2)->get();
            return view('Dashboard.doctor.invoice.review_invoices' ,compact('invoices'));
        }

        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    // قائمة الفواتير المكتملة
    public function completeInvoice(){

        try{

            $invoices = Invoice::where('doctor_id',Auth::user()->id)->where('invoice_status',3)->get();
            return view('Dashboard.doctor.invoice.completed_invoices' ,compact('invoices'));
        }

        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
