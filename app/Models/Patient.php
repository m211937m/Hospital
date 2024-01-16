<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    use Translatable;
    public $fillable = ['email','Password','Date_Birth','phone','Gender','Blood_Group','name','Address'];
    public $translatedAttributes =['name','Address'];

}
