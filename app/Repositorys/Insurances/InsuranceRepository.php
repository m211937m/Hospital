<?Php

namespace App\Repositorys\Insurances;

use App\Interfaces\Insurances\InsuranceInterface;
use App\Models\Insurance;
use Exception;

class InsuranceRepository implements InsuranceInterface
{
    public function index()
    {
        try{

            $insurances = Insurance::all();
            return view("Dashboard.insurance.index",compact("insurances"));
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function create(){

        return view('Dashboard.insurance.create');
    }
    public function store($request)
    {
        try{
            //save Insurance
            $insurance = new Insurance();
            $insurance->insurance_code = $request->insurance_code;
            $insurance->discount_percentage = $request->discount_percentage;
            $insurance->Company_rate = $request->Company_rate;
            $insurance->status = 1;
            $insurance->save();

            //save translatio Insurance
            $insurance->name = $request->name;
            $insurance->note = $request->notes;
            $insurance->save();

            session()->flash("add");
            return redirect()->route('insurance.index');

        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id){
        try{
            $insurances =Insurance::findorfail($id);
            return view('Dashboard.insurance.edit',compact('insurances'));

        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request){
        try{
            if(!$request->has('status')){
                $request->request->add(['status' => 0]);
            }
            else{
                $request->request->add(['status' => 1]);
            }
            //save Insurance
            $insurance =  Insurance::findorfail($request->id);
            $insurance->insurance_code = $request->insurance_code;
            $insurance->discount_percentage = $request->discount_percentage;
            $insurance->Company_rate = $request->Company_rate;
            $insurance->status = $request->status;
            $insurance->save();

            //save translatio Insurance
            $insurance->name = $request->name;
            $insurance->note = $request->notes;
            $insurance->save();

            session()->flash("edit");
            return redirect()->route('insurance.index');

        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request){
        try{
            Insurance::findorFail($request->id)->delete();
                session()->flash("delete");
                return redirect()->route('insurance.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
