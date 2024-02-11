<?php

use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\RecipAccountController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use App\Http\Controllers\Dashboard\PaymentAccountsController;
use App\Http\Controllers\doctor\Diagnostic;
use App\Http\Controllers\doctor\InvoiceContoller;
use App\Http\Controllers\doctor\LaboratorieController;
use App\Http\Controllers\doctor\PatientDetailsController;
use App\Http\Controllers\doctor\Raycontroller;
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


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        Route::get('/dashboard/doctor', function () {
        return view('Dashboard.doctor.dashboard');})->middleware(['auth:doctor', 'verified'])->name('dashboard.doctor');

        Route::middleware('auth:doctor')->group(function () {
            Route::get('complete_Invoice', [InvoiceContoller::class,'completeInvoice'])->name('completeInvoice');
            Route::get('review_Invoices', [InvoiceContoller::class,'reviewInvoices'])->name('reviewInvoices');
            Route::post('add_review', [Diagnostic::class,'add_review'])->name('add_review');
            Route::get('Patient_Details/{id}', [PatientDetailsController::class,'index'])->name('Patient.Details');
            Route::get('show.laboratorie/{id}', [PatientDetailsController::class,'show'])->name('show.laboratorie');
            Route::resource('invoice', InvoiceContoller::class);
            Route::resource('Diagnostics', Diagnostic::class);
            Route::resource('rays', Raycontroller::class);
            Route::resource('Laboratories', LaboratorieController::class);

        });
        require __DIR__.'/auth.php';
    });

    //



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

