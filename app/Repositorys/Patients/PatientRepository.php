<?Php

namespace App\Repositorys\Patients;

use App\Interfaces\Patients\PatientInterface;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Patient_account;
use App\Models\RecipAccount;
use App\Models\single_invoices;
use Exception;

class PatientRepository implements PatientInterface
{
    public function index()
    {
        try{
            $Patients = Patient::all();
            return view("Dashboard.Patients.index",compact("Patients"));
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function create(){
        try{
            return view('Dashboard.Patients.create');

        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function store($request)
    {
        try{
            //save Patient
            $Patient = new Patient();
            $Patient->email = $request->email;
            $Patient->password = $request->Phone;
            $Patient->Date_Birth = $request->Date_Birth;
            $Patient->phone = $request->Phone;
            $Patient->Gender = $request->Gender;
            $Patient->Blood_Group = $request->Blood_Group;
            $Patient->save();

            //save translatio Patient
            $Patient->name = $request->name;
            $Patient->Address = $request->Address;
            $Patient->save();

            session()->flash("add");
            return redirect()->route('Patients.index');

        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id){

        try{

            $Patient = Patient::findorfail($id);
            return view('Dashboard.Patients.edit',compact('Patient'));
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function show($id){

        try{

            $Patient = Patient::findorfail($id);
            $invoices = Invoice::where('patient_id',$id)->get();
            $receipt_accounts = RecipAccount::where('patient_id',$id)->get();
            $Patient_accounts = Patient_account::orWhereNotNull('invoice_id')
            ->orWhereNotNull('receip_id')
            ->orWhereNotNull('payment_id')
            ->where('patient_id',$id)
            ->get();
            return view('Dashboard.Patients.show',compact(['Patient','invoices','receipt_accounts','Patient_accounts']));
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request){
        try{
            $Patient = Patient::findorfail($request->id);
            $Patient->email = $request->email;
            $Patient->password = $request->Phone;
            $Patient->Date_Birth = $request->Date_Birth;
            $Patient->phone = $request->Phone;
            $Patient->Gender = $request->Gender;
            $Patient->Blood_Group = $request->Blood_Group;
            $Patient->save();

            $Patient->name = $request->name;
            $Patient->Address = $request->Address;
            $Patient->save();

            session()->flash("edit");
            return redirect()->route('Patients.index');

        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request){
        try{

            Patient::findorfail($request->id)->delete();
            session()->flash("delete");
            return redirect()->route('Patients.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
