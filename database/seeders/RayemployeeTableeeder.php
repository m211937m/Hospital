<?php

namespace Database\Seeders;

use App\Models\Ray_employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RayemployeeTableeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ray = new Ray_employee();
        $ray->price = "5000";
        $ray->email = "ray@gimal.com";
        $ray->password = Hash::make('123456789');
        $ray->name = "محمد";
        $ray->save();
    }
}
