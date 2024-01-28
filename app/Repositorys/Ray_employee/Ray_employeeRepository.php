<?Php

namespace App\Repositorys\Ray_employee;

use App\Interfaces\Ray_employee\Ray_employeeInterface;
use App\Models\Ray_employee;
use App\Models\Section;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class Ray_employeeRepository implements Ray_employeeInterface
{
    public function index()
    {
        try{

            $ray_employees = Ray_employee::all();
            return view("Dashboard.ray_employee.index",compact("ray_employees"));
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function store($request)
    {
        try{
            Ray_employee::create([
                'name' => $request->name,
                'price' => $request->price,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            session()->flash("add");
            return redirect()->route('ray_employee.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function update($request,$id){
        try{

            $input = $request->all();

            if(!empty($input['password'])){
                $input['password'] = Hash::make($input['password']);
            }
            else{
                $input = Arr::except($input, ['password']);
            }

            $ray_employee = Ray_employee::find($id);
            $ray_employee->update($input);
                session()->flash("edit");
                return redirect()->route('ray_employee.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id){
        try{

            Ray_employee::findorFail($id)->delete();
                session()->flash("delete");
                return redirect()->route('ray_employee.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
