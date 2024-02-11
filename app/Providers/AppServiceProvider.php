<?php

namespace App\Providers;

    use App\Interfaces\Ambulances\AmbulanceInterface;
    use App\Interfaces\doctor_dashboard\DiagnosisInterface;
    use App\Interfaces\doctor_dashboard\InvoicesInterface;
    use App\Interfaces\doctor_dashboard\LaboratorieInterface;
    use App\Interfaces\doctor_dashboard\RayInterface;
    use App\Interfaces\Doctors\DoctorInterface;
    use App\Interfaces\Finance\PaymentRepositoryInterface;
    use App\Interfaces\Finance\ReceiptRepositoryInterface;
    use App\Interfaces\Insurances\InsuranceInterface;
use App\Interfaces\lab_emp_dashborad\InvoicesInterface as Lab_emp_dashboradInvoicesInterface;
use App\Interfaces\Laboratorie_employee\Laboratorie_employeeInterface;
use App\Interfaces\Patients\PatientInterface;
    use App\Interfaces\Ray_employee\Ray_employeeInterface;
use App\Interfaces\ray_employee_dashborad\InvoicesInterface as Ray_employee_dashboradInvoicesInterface;
use App\Interfaces\Sections\SectionInterface;
    use App\Interfaces\Services\SingleServiceInterface;
    use App\Repositorys\Ambulances\AmbulanceRepository;
    use App\Repositorys\doctor_dashboard\DiagnosisRepository;
    use App\Repositorys\doctor_dashboard\InvoiceRepository;
    use App\Repositorys\doctor_dashboard\LaboratorieRepository;
    use App\Repositorys\doctor_dashboard\RayRepository;
    use App\Repositorys\Doctors\DoctorRepository;
    use App\Repositorys\Finance\PaymentRepository;
    use App\Repositorys\Finance\ReceiptRepositoryRepository;
    use App\Repositorys\Insurances\InsuranceRepository;
use App\Repositorys\lab_emp_dashborad\InvoiceRepository as Lab_emp_dashboradInvoiceRepository;
use App\Repositorys\Laboratorie_employee\Laboratorie_employeeRepository;
use App\Repositorys\Patients\PatientRepository;
    use App\Repositorys\Ray_employee\Ray_employeeRepository;
use App\Repositorys\ray_employee_dashborad\InvoiceRepository as Ray_employee_dashboradInvoiceRepository;
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
        //Ray_employee
        $this->app->bind(
            Ray_employeeInterface::class, // the interface
            Ray_employeeRepository::class, // the implementation
        );
        //Laboratorie_employee
        $this->app->bind(
            Laboratorie_employeeInterface::class, // the interface
            Laboratorie_employeeRepository::class, // the implementation
        );

        // --------------------------------------------- //doctor//-----------------------------------------------------

        //Invoice
        $this->app->bind(
            InvoicesInterface::class, // the interface
            InvoiceRepository::class, // the implementation
        );

        //Diagnosis
        $this->app->bind(
            DiagnosisInterface::class, // the interface
            DiagnosisRepository::class, // the implementation
        );

        // Ray
        $this->app->bind(
            RayInterface::class, // the interface
            RayRepository::class, // the implementation
        );

        //Laboratorie
        $this->app->bind(
            LaboratorieInterface::class, // the interface
            LaboratorieRepository::class, // the implementation
        );

        // --------------------------------------------- //ray_employee//-----------------------------------------------------

        //Invoice
        $this->app->bind(
            Ray_employee_dashboradInvoicesInterface::class, // the interface
            Ray_employee_dashboradInvoiceRepository::class, // the implementation
        );
        // --------------------------------------------- //lab_employee//-----------------------------------------------------

        //Invoice
        $this->app->bind(
            Lab_emp_dashboradInvoicesInterface::class, // the interface
            Lab_emp_dashboradInvoiceRepository::class, // the implementation
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
