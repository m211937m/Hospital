<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientsTableeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $Patient = new Patient();
            $Patient->email = 'pa@gimal.com';
            $Patient->password = Hash::make('123456789');
            $Patient->Date_Birth = '1999-12-2';
            $Patient->phone = '123456789';
            $Patient->Gender = 1;
            $Patient->Blood_Group = 'A+';
            $Patient->save();

            //save translatio Patient
            $Patient->name = 'محمد';
            $Patient->Address = 'حمص تل الناقة';
            $Patient->save();
    }
}
