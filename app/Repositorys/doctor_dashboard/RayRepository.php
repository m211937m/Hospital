<?Php

namespace App\Repositorys\doctor_dashboard;

use App\Interfaces\doctor_dashboard\RayInterface;
use App\Models\Ray;
use Exception;
use Illuminate\Support\Facades\DB;

class RayRepository implements RayInterface
{
    public function store($requset)
    {
        try{
            DB::beginTransaction();
            $Ray = new Ray();
            $Ray->date = date('Y-m-d');
            $Ray->invoice_id = $requset->invoice_id;
            $Ray->doctor_id = $requset->doctor_id;
            $Ray->patient_id = $requset->patient_id;
            $Ray->save();

            $Ray->descriptio = $requset->description;
            $Ray->save();

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
            $Ray = Ray::findorfail($id);
            $Ray->descriptio = $requset->description;
            $Ray->save();

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

            Ray::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        }

        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }


}
