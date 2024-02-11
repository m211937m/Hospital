<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\lab_empRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class lab_empController extends Controller
{
    public function store(lab_empRequest $request)
    {
        if($request->authenticate()){
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::LAB_EMP);
        }

        return redirect()->back()->withErrors([ 'name' => (trans('Dashboard/auth.failed'))]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('lab_emp')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
