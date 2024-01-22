<?Php

namespace App\Repositorys\doctor_dashboard;

use App\Interfaces\doctor_dashboard\InvoicesInterface;
use App\Models\Invoice;
use Exception;
use Illuminate\Support\Facades\Auth;

class InvoiceRepository implements InvoicesInterface
{
    public function index(){

        try{

            $invoices = Invoice::where('doctor_id',Auth::user()->id)->get();
            return view('Dashboard.doctor.invoice.index' ,compact('invoices'));
        }

        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    
}
