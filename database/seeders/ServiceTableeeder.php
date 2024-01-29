<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceTableeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = new Service();
        $service->price = 500;
        $service->status = 1;
        $service->save();

        //store trans
        $service->name = 'كشف';
        $service->description = "لا يوجد وصف";
        $service->save();

    }
}
