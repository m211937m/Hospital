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
        try{
            $doctors = Doctor::with('doctorappointments')->get();
            return view("Dashboard.Doctors.index",compact("doctors"));
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function create()
    {
        try{

            $sections = Section::all();
            $appointments = Appointment::all();
            return view('Dashboard.Doctors.add',compact(['sections','appointments']));
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
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

            // store trans doctor
            $doctors->name = $request->name;
            $doctors->save();

            $doctors->doctorappointments()->attach($request->appointments);
            //save image
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
        try{

            //delete one doctor
            if($request->page_id == 1){
                //found image to delete
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
                    $doctor = Doctor::findorfail($id_doctor);
                    if($doctor->image){
                        $this->delete_attachment('upload_image','doctor/'.$doctor->image->filename,$id_doctor);
                    }
                    Doctor::destroy($request->id);
                }
                session()->flash("delete");
                return redirect()->route('Doctors.index');
            }
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id){

        $sections = Section::all();
        $appointments = Appointment::all();
        $doctor = Doctor::findorfail($id);
        return view('Dashboard.Doctors.edit',compact(['sections','appointments','doctor']));
    }

    public function update($request){

        DB::beginTransaction();

        try{

            $doctors =  Doctor::findorfail($request->id);
            $doctors->email = $request->email;
            $doctors->section_id = $request->section_id;
            $doctors->phone = $request->phone;
            $doctors->save();

            // store trans
            $doctors->name = $request->name;
            $doctors->save();

            $doctors->doctorappointments()->sync($request->appointments);
            //upload image
            if($request->has('photo')){

                if($doctors->image){
                    $old = $doctors->image->filename;
                    $this->delete_attachment('upload_image','doctor/'.$old,$request->id);
                }
                $this->verifyAndStoreImage($request,'photo','doctor','upload_image',$request->id,'App\Models\Doctor' );
            }

            DB::commit();
            session()->flash("edit");
            return redirect()->route('Doctors.index');

        }
        catch(Exception $e){

            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update_password($request){
        try{

            $doctor = Doctor::findorfail($request->id);
            $doctor->password = Hash::make($request->password);
            $doctor->save();
            session()->flash('edit');
            return redirect()->route('Doctors.index');
        }

        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function status($request){
        try{

            $doctor = Doctor::findorfail($request->id);
            $doctor->status = $request->status;
            $doctor->save();
            session()->flash('edit');
            return redirect()->route('Doctors.index');
        }

        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
