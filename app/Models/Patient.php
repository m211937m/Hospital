<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Patient extends User
{
    use HasFactory;
    use Translatable;
    public $fillable = ['email','password','Date_Birth','phone','Gender','Blood_Group','name','Address'];
    public $translatedAttributes =['name','Address'];

}
