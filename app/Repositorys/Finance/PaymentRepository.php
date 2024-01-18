<?Php

namespace App\Repositorys\Finance;

use App\Interfaces\Finance\PaymentRepositoryInterface;
use App\Models\FondAccount;
use App\Models\Patient;
use App\Models\Patient_account;
use App\Models\PaymentAccounts;
use App\Models\RecipAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function index()
    {
        try{

            $payments = PaymentAccounts::all();
            return view('Dashboard.Payment.index',compact('payments'));
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function create()
    {
        try{
            $Patients = Patient::all();
            return view('Dashboard.Payment.add',compact('Patients'));

        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function store($request)
    {
        DB::beginTransaction();
        try{

            //PaymentAccounts save
            $PaymentAccounts = new PaymentAccounts();
            $PaymentAccounts->date = date('Y-m-d');
            $PaymentAccounts->patient_id = $request->patient_id;
            $PaymentAccounts->amount = $request->credit;
            $PaymentAccounts->description = $request->description;
            $PaymentAccounts->save();

            //FondAccount save
            $fund_accounts = new FondAccount();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->payment_id = $PaymentAccounts->id;
            $fund_accounts->credit = $request->credit;
            $fund_accounts->Dabit = 0.00;
            $fund_accounts->save();

            //patient_account save
            $patient_accounts = new Patient_account();
            $patient_accounts->date = date('Y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->payment_id = $PaymentAccounts->id;
            $patient_accounts->Dabit = $request->credit;
            $patient_accounts->credit =0.0;
            $patient_accounts->save();

            DB::commit();
            session()->flash('add');
            return redirect()->route('Payment.index');
        }
        catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors([ 'error' => $e->getMessage()]);

        }

    }

    public function show($id)
    {
        try{

            $payment_account = PaymentAccounts::findorfail($id);
            return view('Dashboard.Payment.print',compact(['payment_account']) );
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try{

            $payment_accounts = PaymentAccounts::findorfail($id);
            $Patients = Patient::all();
            return view('Dashboard.Payment.edit',compact(['payment_accounts','Patients']) );
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }
    public function update($request){

        DB::beginTransaction();
        try{

            //payment_accounts save
            $PaymentAccounts = PaymentAccounts::findorfail($request->id);
            $PaymentAccounts->date = date('Y-m-d');
            $PaymentAccounts->patient_id = $request->patient_id;
            $PaymentAccounts->amount = $request->credit;
            $PaymentAccounts->description = $request->description;
            $PaymentAccounts->save();

            //FondAccount save
            $fund_accounts = FondAccount::where('payment_id',$request->id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->payment_id = $PaymentAccounts->id;
            $fund_accounts->credit = $request->credit;
            $fund_accounts->Dabit = 0.00;
            $fund_accounts->save();

            //patient_account save
            $patient_accounts = Patient_account::where('payment_id', $request->id)->first();
            $patient_accounts->date = date('Y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->payment_id = $PaymentAccounts->id;
            $patient_accounts->Dabit = $request->credit;
            $patient_accounts->credit =0.0;
            $patient_accounts->save();

            DB::commit();
            session()->flash('edit');
            return redirect()->route('Payment.index');
        }
        catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors([ 'error' => $e->getMessage()]);

        }

    }


    public function destroy($request){

        try{
            PaymentAccounts::destroy($request->id);
            session()->flash('delete');
            return redirect()->route('Payment.index');
        }

        catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors([ 'error' => $e->getMessage()]);
        }
    }
}
