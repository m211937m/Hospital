<?php

namespace App\Providers;

use App\Interfaces\Doctors\DoctorInterface;
use App\Interfaces\Sections\SectionInterface;
use App\Repositorys\Doctors\DoctorRepository;
use App\Repositorys\Sections\SectionRepository;
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
