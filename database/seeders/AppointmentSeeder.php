<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments')->delete();


        $appointmens = [
            ['name'=>'السبت'],
            ['name'=>'الاحد'],
            ['name'=>'الاثنين'],
            ['name'=>'الثلاثاء'],
            ['name'=>'الاربعاء'],
            ['name'=>'الخميس'],
            ['name'=>'الجمعة'],
        ];
        foreach ($appointmens as $appointmen){
            Appointment::create($appointmen);
        }
    }
}
