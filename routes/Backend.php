<?php

use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\SingleServiceController;
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

        Route::get('/dashboard/user', function () {
            return view('Dashboard.User.dashboard');})->middleware(['auth', 'verified'])->name('dashboard.user');

        Route::get('/dashboard/admin', function () {
            return view('Dashboard.Admin.dashboard');})->middleware(['auth:admin', 'verified'])->name('dashboard.admin');

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
            //insurance
            Route::resource('insurance', InsuranceController::class);
            //Ambulances
            Route::resource('Ambulance', AmbulanceController::class);
            //Patient
            Route::resource('Patients', PatientController::class);

        });
        require __DIR__.'/auth.php';
    });

    //



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

