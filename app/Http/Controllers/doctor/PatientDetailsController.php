<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Models\Diagnostic;
use App\Models\Laboratorie;
use App\Models\Patient;
use App\Models\Ray;
use Illuminate\Http\Request;

class PatientDetailsController extends Controller
{
    public function index($id){
        $Patient = Patient::findorfail($id)->first();
        $patient_records = Diagnostic::where('patient_id',$id)->get();
        $patient_rays = Ray::where('patient_id',$id)->get();
        $patient_Laboratories = Laboratorie::where('patient_id',$id)->get();
        return view('Dashboard.doctor.invoice.patient_details',compact(['Patient','patient_records','patient_rays','patient_Laboratories']));
    }
}
