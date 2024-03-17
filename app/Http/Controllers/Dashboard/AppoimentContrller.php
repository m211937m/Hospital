<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Appointmen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AppoimentContrller extends Controller
{
    public function index(){
        $appointments = Appointmen::where('type',1)->get();
        return view("Dashboard.appointments.index",compact('appointments'));
    }
    public function approval(Request $request){
        $appointments = Appointmen::findOrFail($request->id);
        $appointments->appointment = $request->appointment;
        $appointments->type = 2;
        $appointments->save();
        

        // Mail::to('',new );

        session()->flash("add");
        return back();
    }
    public function index2(){
        $appointments = Appointmen::where('type',2)->get();
        return view("Dashboard.appointments.index2",compact('appointments'));
    }
}
