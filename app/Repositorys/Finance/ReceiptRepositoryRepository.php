<?Php

namespace App\Repositorys\Finance;

use App\Interfaces\Finance\ReceiptRepositoryInterface;
use App\Models\FondAccount;
use App\Models\Patient;
use App\Models\Patient_account;
use App\Models\RecipAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptRepositoryRepository implements ReceiptRepositoryInterface
{
    public function index()
    {
        try{

            $receipts = RecipAccount::all();
            return view('Dashboard.Receipt.index',compact('receipts'));
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function create()
    {
        try{
            $Patients = Patient::all();
            return view('Dashboard.Receipt.add',compact('Patients'));

        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function store($request)
    {
        DB::beginTransaction();
        try{

            //receipt_accounts save
            $receipt_accounts = new RecipAccount();
            $receipt_accounts->date = date('Y-m-d');
            $receipt_accounts->patient_id = $request->patient_id;
            $receipt_accounts->Debit = $request->Debit;
            $receipt_accounts->description = $request->description;
            $receipt_accounts->save();

            //FondAccount save
            $fund_accounts = new FondAccount();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->receip_id = $receipt_accounts->id;
            $fund_accounts->Dabit = $request->Debit;
            $fund_accounts->credit = 0.0;
            $fund_accounts->save();

            //patient_account save
            $patient_accounts = new Patient_account();
            $patient_accounts->date = date('Y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->receip_id = $receipt_accounts->id;
            $patient_accounts->Dabit = 0.00;
            $patient_accounts->credit = $request->Debit;
            $patient_accounts->save();

            DB::commit();
            session()->flash('add');
            return redirect()->route('Receipt.index');
        }
        catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors([ 'error' => $e->getMessage()]);

        }

    }

    public function edit($id)
    {
        try{

            $receipt_accounts = RecipAccount::findorfail($id);
            $Patients = Patient::all();
            return view('Dashboard.Receipt.edit', compact(['receipt_accounts','Patients']) );
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }
    public function update($request){

        DB::beginTransaction();
        try{

            //receipt_accounts save
            $receipt_accounts = RecipAccount::findorfail($request->id);
            $receipt_accounts->date = date('Y-m-d');
            $receipt_accounts->patient_id = $request->patient_id;
            $receipt_accounts->Debit = $request->Debit;
            $receipt_accounts->description = $request->description;
            $receipt_accounts->save();

            //FondAccount save
            $fund_accounts = FondAccount::where('receip_id',$request->id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->receip_id = $receipt_accounts->id;
            $fund_accounts->Dabit = $request->Debit;
            $fund_accounts->credit = 0.0;
            $fund_accounts->save();

            //patient_account save
            $patient_accounts = Patient_account::where('receip_id', $request->id)->first();
            $patient_accounts->date = date('Y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->receip_id = $receipt_accounts->id;
            $patient_accounts->Dabit = 0.00;
            $patient_accounts->credit = $request->Debit;
            $patient_accounts->save();

            DB::commit();
            session()->flash('edit');
            return redirect()->route('Receipt.index');
        }
        catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors([ 'error' => $e->getMessage()]);

        }

    }


    public function destroy($request){

        try{
            RecipAccount::destroy($request->id);
            session()->flash('delete');
            return redirect()->route('Receipt.index');
        }

        catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors([ 'error' => $e->getMessage()]);
        }
    }
}
