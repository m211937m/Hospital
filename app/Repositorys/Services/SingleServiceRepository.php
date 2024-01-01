<?Php

namespace App\Repositorys\Services;

use App\Interfaces\Services\SingleServiceInterface;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;

class SingleServiceRepository implements SingleServiceInterface
{
    public function index()
    {
        $services = Service::all();
        return view('Dashboard.Services.Single_Service.index',compact('services'));

    }
    public function store($request)
    {
        try{
            $service = new Service();
            $service->price = $request->price;
            $service->status = 1;
            $service->save();

            //store trans
            $service->name = $request->name;
            $service->description = $request->description;
            $service->save();

            session()->flash('add');
            return redirect()->route('Services.index');
        }
        catch(Exception $e){
           return redirect()->back()->withErrors(['erore' => $e->getMessage()]);
        }

    }
    public function update($request)
    {
        try{
            $service = Service::findorfail($request->id);
            $service->price = $request->price;
            $service->status = $request->status;
            $service->save();

            //store trans
            $service->name = $request->name;
            $service->description = $request->description;
            $service->save();

            session()->flash('edit');
            return redirect()->route('Services.index');
        }
        catch(Exception $e){
           return redirect()->back()->withErrors(['erore' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try{
            $service = Service::destroy($request->id);
            session()->flash('delete');
            return redirect()->route('Services.index');

        }

        catch(Exception $e){
            return redirect()->back()->withErrors(['erore' => $e->getMessage()]);
         }

    }
}
