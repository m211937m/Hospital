<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ray extends Model
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['descriptio','descriptio_employee'];
    public $fillable = ['date','descriptio','descriptio_employee','doctor_id','invoice_id','patient_id'];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function employee(){
        return $this->belongsTo(Ray_employee::class)->withDefault(['name'=> 'noEmployee']);
    }

    public function Patient(){
        return $this->belongsTo(Patient::class);
    }
    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
