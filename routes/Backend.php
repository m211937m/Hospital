<?php

use App\Events\MyEvent;
use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\LaboratorieEemployeeController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\RecipAccountController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use App\Http\Controllers\Dashboard\PaymentAccountsController;
use App\Http\Controllers\Dashboard\Ray_employee;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/Dashboard_admin',[DashboardController::class , 'index']);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){


        Route::get('/dashboard/admin', function () {
            $date['service'] = App\Models\Service::count();
            $date['group'] = App\Models\Group::count();
            $date['doctor'] = App\Models\Doctor::count();
            $date['patient'] = App\Models\Patient::count();
            $date['section'] = App\Models\Section::count();
            return view('Dashboard.Admin.dashboard',$date);
        })->middleware(['auth:admin', 'verified'])->name('dashboard.admin');



        Route::middleware('auth:admin')->group(function () {
            //Section
            Route::resource('Sections', SectionController::class);
            // Doctor
            Route::resource('Doctors', DoctorController::class);
            Route::post('update_password',[ DoctorController::class,'update_password'])->name('doctor.update_password');
            Route::post('status',[ DoctorController::class,'status'])->name('doctor.status');
            //Services
            Route::resource('Services', SingleServiceController::class);
            //GroupServices
            Route::view('Add_GroupServise','livewire.GroupServices.include_create')->name('Add_GroupServise');
            //single_invoices
            Route::view('single_invoices','livewire.single_invoices.index')->name('single_invoices');
            Route::view('print_single_invoices','livewire.single_invoices.print')->name('print_single_invoices');
            //group_invoices
            Route::view('group_invoices','livewire.group_invoices.index')->name('group_invoices');
            Route::view('print_group_invoices','livewire.group_invoices.print')->name('print_group_invoices');
            //insurance
            Route::resource('insurance', InsuranceController::class);
            //Ambulances
            Route::resource('Ambulance', AmbulanceController::class);
            //Patient
            Route::resource('Patients', PatientController::class);
            //Receipt
            Route::resource('Receipt', RecipAccountController::class);
            //Payment
            Route::resource('Payment', PaymentAccountsController::class);
            //Ray_employee
            Route::resource('ray_employee', Ray_employee::class);
            // laboratorie_employee
            Route::resource('laboratorie_employee', LaboratorieEemployeeController::class);

        });
        require __DIR__.'/auth.php';
    });

    //



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

