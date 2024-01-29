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
    use App\Http\Controllers\doctor\LaboratorieController;
    use App\Http\Controllers\doctor\PatientDetailsController;
    use App\Http\Controllers\doctor\Raycontroller;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\RayEmployee\InvoiceController;
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

        Route::get('/dashboard/ray_employee', function () {
        return view('Dashboard.dashboard_RayEmployee.dashboard');})->middleware(['auth:ray_employee', 'verified'])->name('dashboard.ray_employee');

        Route::middleware('auth:ray_employee')->group(function () {
            Route::get('invoices',[InvoiceController::class,'index'])->name('rayemployee.invoice.index');


        });
        require __DIR__.'/auth.php';
    });

    //



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

