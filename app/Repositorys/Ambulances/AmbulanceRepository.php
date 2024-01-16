<?Php

namespace App\Repositorys\Ambulances;

use App\Interfaces\Ambulances\AmbulanceInterface;
use App\Models\Ambulance;
use Exception;

class AmbulanceRepository implements AmbulanceInterface
{
    public function index(){

        $ambulances = Ambulance::all();
        return view("Dashboard.Ambulances.index",compact("ambulances"));
    }

    public function create(){

        return view('Dashboard.Ambulances.create');
    }
    public function store($request)
    {
        try{

            $ambulances = new Ambulance();
            $ambulances->car_numper = $request->car_numper;
            $ambulances->car_model = $request->car_model;
            $ambulances->car_year_model = $request->car_year_model;
            $ambulances->car_type = $request->car_type;
            $ambulances->is_available = 1;
            $ambulances->save();

            session()->flash("add");
            return redirect()->route('Ambulance.index');

        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id){

        $ambulance = Ambulance::findorfail($id);
        return view('Dashboard.Ambulances.edit',compact('ambulance'));
    }

    public function update($request){
        try{
            if(!$request->has('is_available')){
                $request->request->add(['is_available' => 0]);
            }
            else{
                $request->request->add(['is_available' => 1]);
            }
            $ambulances =  Ambulance::findorfail($request->id);
            $ambulances->car_numper = $request->car_numper;
            $ambulances->car_model = $request->car_model;
            $ambulances->car_year_model = $request->car_year_model;
            $ambulances->car_type = $request->car_type;
            $ambulances->is_available = $request->is_available;
            $ambulances->save();

            session()->flash("edit");
            return redirect()->route('Ambulance.index');

        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request){
        Ambulance::findorfail($request->id)->delete();
        session()->flash("delete");
        return redirect()->route('Ambulance.index');

    }
}
