<?php

use App\Http\Controllers\Patients\InvoicepatienteController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Chat\Creatchat;
use App\Http\Livewire\Chat\Main;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
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
        Route::get('/', function () {
            return view('welcome');
        })->name('home');

        Route::get('/dashboard/Patient', function () {
            return view('Dashboard.dashborad_patients.dashboard');
        })->middleware(['auth:web', 'verified'])->name('dashboard.Patient');
        Route::middleware('auth:web')->group(function () {
            Route::get('patiente/invoice', [InvoicepatienteController::class,'invoice'])->name('patiente.invoices');
            Route::get('patiente/Laboratorie', [InvoicepatienteController::class,'Laboratorie'])->name('patiente.Laboratorie');
            Route::get('patiente/Ray', [InvoicepatienteController::class,'Ray'])->name('patiente.Ray');

            //
            Route::get('list_doctor',Creatchat::class)->name('list.doctor');
            Route::get('chat_doctor',Main::class)->name('chat.doctor');
        });

        require __DIR__.'/auth.php';
    });
    Route::middleware('auth:web')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
