<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ray_employee extends Model
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['name'];
    public $fillable = ['price','name','password','email'];

}
