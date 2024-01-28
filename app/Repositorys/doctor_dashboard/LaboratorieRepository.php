<?Php

namespace App\Repositorys\doctor_dashboard;

use App\Interfaces\doctor_dashboard\LaboratorieInterface;
use App\Models\Laboratorie;
use Exception;
use Illuminate\Support\Facades\DB;

class LaboratorieRepository implements LaboratorieInterface
{
    public function store($requset)
    {
        try{
            DB::beginTransaction();
            $Laboratorie = new Laboratorie();
            $Laboratorie->date = date('Y-m-d');
            $Laboratorie->invoice_id = $requset->invoice_id;
            $Laboratorie->doctor_id = $requset->doctor_id;
            $Laboratorie->patient_id = $requset->patient_id;
            $Laboratorie->save();

            $Laboratorie->description = $requset->description;
            $Laboratorie->save();

            DB::commit();
            session()->flash('add');
            return redirect()->back();
        }

        catch(Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function update($requset,$id)
    {
        try{
            DB::beginTransaction();
            $Laboratorie = Laboratorie::findorfail($id);
            $Laboratorie->description = $requset->description;
            $Laboratorie->save();

            DB::commit();
            session()->flash('edit');
            return redirect()->back();
        }

        catch(Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function destroy($id)
    {
        try{

            Laboratorie::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        }

        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
