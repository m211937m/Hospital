<?Php

namespace App\Repositorys\Doctors;

use App\Interfaces\Doctors\DoctorInterface;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Section;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DoctorRepository implements DoctorInterface
{

    use UploadTrait;
    public function index()
    {
        $doctors = Doctor::all();
        return view("Dashboard.Doctors.index",compact("doctors"));
    }
    public function create()
    {
        $sections = Section::all();
        $appointments = Appointment::all();
        return view('Dashboard.Doctors.add',compact(['sections','appointments']));
    }
    public function store($request){

        DB::beginTransaction();

        try{

            $doctors = new Doctor();
            $doctors->email = $request->email;
            $doctors->password = Hash::make($request->password);
            $doctors->section_id = $request->section_id;
            $doctors->phone = $request->phone;
            $doctors->status = 1;
            $doctors->save();

            // store trans
            $doctors->name = $request->name;
            $appointments = $request->appointments ?? [];
            $doctors->appointments = implode(",", $appointments);
            $doctors->save();

            //upload image
            $this->verifyAndStoreImage($request,'photo','doctor','upload_image',$doctors->id,'App\Models\Doctor' );

            DB::commit();
            session()->flash("add");
            return redirect()->route('Doctors.index');

        }
        catch(Exception $e){

            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function destroy($request){
        if($request->page_id == 1){
            if ($request->filename)
            {
                $this->delete_attachment('upload_image','doctor/'.$request->filename,$request->id);
            }
            Doctor::destroy($request->id);
            session()->flash("delete");
            return redirect()->route('Doctors.index');

        }

        //delete mane doctor
        else{

            $delete_select_id = explode(',',$request->delete_select_id);

            foreach($delete_select_id as $id_doctor){
                $doctor = Doctor::findorfall($id_doctor);
                if($doctor->image){
                    $this->delete_attachment('upload_image','doctor/'.$doctor->image->filename,$id_doctor);
                }
                Doctor::destroy($request->id);
            }
            session()->flash("delete");
            return redirect()->route('Doctors.index');
        }
    }
}
