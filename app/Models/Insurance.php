<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;
    use Translatable;
    public $fillable = ['insurance_code','discount_percentage','Company_rate','status','name','note'];
    public $translatedAttributes = ['name','note'];
}
