<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Lab_emp extends User
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['name'];
    public $fillable = ['price','name','password','email'];
}
