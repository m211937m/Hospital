<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            AppointmentSeeder::class,
            SectionTableSeeder::class,
            DoctorTableSeeder::class,
            ServiceTableeeder::class,
            PatientsTableeeder::class,
            RayemployeeTableeeder::class,
            // ImageTableSeeder::class,
        ]);
    }
}
