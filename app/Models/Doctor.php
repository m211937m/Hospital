<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['name','appointments'];
    public $fillable = ['email','email_verified_at','password','phone','name','appointments','section_id','status'];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function doctorappointments()
    {
        return $this->belongsToMany(Appointment::class,'appointment_doctor');
    }
}
