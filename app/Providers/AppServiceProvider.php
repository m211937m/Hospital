<?php

namespace App\Providers;

use App\Interfaces\Ambulances\AmbulanceInterface;
use App\Interfaces\doctor_dashboard\InvoicesInterface;
use App\Interfaces\Doctors\DoctorInterface;
use App\Interfaces\Finance\PaymentRepositoryInterface;
use App\Interfaces\Finance\ReceiptRepositoryInterface;
use App\Interfaces\Insurances\InsuranceInterface;
use App\Interfaces\Patients\PatientInterface;
use App\Interfaces\Sections\SectionInterface;
use App\Interfaces\Services\SingleServiceInterface;
use App\Repositorys\Ambulances\AmbulanceRepository;
use App\Repositorys\doctor_dashboard\InvoiceRepository;
use App\Repositorys\Doctors\DoctorRepository;
use App\Repositorys\Finance\PaymentRepository;
use App\Repositorys\Finance\ReceiptRepositoryRepository;
use App\Repositorys\Insurances\InsuranceRepository;
use App\Repositorys\Patients\PatientRepository;
use App\Repositorys\Sections\SectionRepository;
use App\Repositorys\Services\SingleServiceRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // --------------------------------------------------------------------------------------------------
        //admin


        //section
        $this->app->bind(
            SectionInterface::class, // the interface
            SectionRepository::class, // the implementation
        );
        //doctor
        $this->app->bind(
            DoctorInterface::class, // the interface
            DoctorRepository::class, // the implementation
        );
        //SingleService
        $this->app->bind(
            SingleServiceInterface::class, // the interface
            SingleServiceRepository::class, // the implementation
        );
        //Insurance
        $this->app->bind(
            InsuranceInterface::class, // the interface
            InsuranceRepository::class, // the implementation
        );
        //Ambulance
        $this->app->bind(
            AmbulanceInterface::class, // the interface
            AmbulanceRepository::class, // the implementation
        );
        //Patient
        $this->app->bind(
            PatientInterface::class, // the interface
            PatientRepository::class, // the implementation
        );
        //ReceiptRepository
        $this->app->bind(
            ReceiptRepositoryInterface::class, // the interface
            ReceiptRepositoryRepository::class, // the implementation
        );
        //PaymentRepository
        $this->app->bind(
            PaymentRepositoryInterface::class, // the interface
            PaymentRepository::class, // the implementation
        );

        // --------------------------------------------------------------------------------------------------
        //doctor


        //Invoice
        $this->app->bind(
            InvoicesInterface::class, // the interface
            InvoiceRepository::class, // the implementation
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
