<?php

use App\Http\Controllers\Lab_Emp\InvoiceController;
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

        Route::get('/dashboard/lab_emp', function () {
        return view('Dashboard.dashboard_Lab_emp.dashboard');
        })->middleware(['auth:lab_emp', 'verified'])->name('dashboard.lab_emp');

        Route::middleware('auth:lab_emp')->group(function () {
            Route::resource('invoices_lab_emp', InvoiceController::class);
            Route::get('complete_invoices_lab_emp', [InvoiceController::class,'complete_invoices'])->name('complete_invoices_lab_emp');
            Route::get('view_lab_emp/{id}', [InvoiceController::class,'viewRays'])->name('view_lab_emp');

        });
        require __DIR__.'/auth.php';
    });

    //



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

