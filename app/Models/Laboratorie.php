<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorie extends Model
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['description','descriptio_employee'];
    public $fillable = ['date','description','doctor_id','invoice_id','patient_id','descriptio_employee','case','lab_emp_id'];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function lab_emp(){
        return $this->belongsTo(Lab_emp::class);
    }
    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
