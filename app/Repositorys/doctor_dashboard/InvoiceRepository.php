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

    // public function create(){
    //     try
    //    { return view('Dashboard.Ambulances.create');}
    //    catch(Exception $e){
    //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    // }
    // }
    // public function store($request)
    // {
    //     try{



    //         session()->flash("add");
    //         return redirect()->route('');

    //     }
    //     catch(Exception $e){
    //         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    //     }
    // }

    // public function edit($id){
    //     try{
    //     $ambulance = Ambulance::findorfail($id);
    //     return view('Dashboard.Ambulances.edit',compact('ambulance'));
    //     }
    //     catch(Exception $e){
    //         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    //     }
    // }

    // public function update($request){
    //     try{
    //         if(!$request->has('is_available')){
    //             $request->request->add(['is_available' => 0]);
    //         }
    //         else{
    //             $request->request->add(['is_available' => 1]);
    //         }
    //         $ambulances =  Ambulance::findorfail($request->id);
    //         $ambulances->car_numper = $request->car_numper;
    //         $ambulances->car_model = $request->car_model;
    //         $ambulances->car_year_model = $request->car_year_model;
    //         $ambulances->car_type = $request->car_type;
    //         $ambulances->is_available = $request->is_available;
    //         $ambulances->save();

    //         session()->flash("edit");
    //         return redirect()->route('Ambulance.index');

    //     }
    //     catch(Exception $e){
    //         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    //     }
    // }

    // public function destroy($request){
    //     try{
    //         Ambulance::findorfail($request->id)->delete();
    //         session()->flash("delete");
    //         return redirect()->route('Ambulance.index');
    //     }
    //     catch(Exception $e){
    //         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    //     }
    // }
}
