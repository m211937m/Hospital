<?Php

namespace App\Repositorys\Laboratorie_employee;

use App\Interfaces\Laboratorie_employee\Laboratorie_employeeInterface;
use App\Models\Lab_emp;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Laboratorie_employeeRepository implements Laboratorie_employeeInterface
{
    public function index()
    {
        try{

            $laboratorie_employees = Lab_emp::get();
            return view("Dashboard.laboratorie_employee.index",compact("laboratorie_employees"));
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function store($request)
    {
        try{
            DB::beginTransaction();
            Lab_emp::create([
                'name' => $request->name,
                'price' => $request->price,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            DB::commit();
            session()->flash("add");
            return redirect()->route('laboratorie_employee.index');
        }
        catch(Exception $e){
            DB::rollBack();
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

            $ray_employee = Lab_emp::find($id);
            $ray_employee->update($input);
                session()->flash("edit");
                return redirect()->route('laboratorie_employee.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id){
        try{

            Lab_emp::findorFail($id)->delete();
                session()->flash("delete");
                return redirect()->route('laboratorie_employee.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
