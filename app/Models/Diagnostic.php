<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{

    use HasFactory;
    use Translatable;
    public $translatedAttributes=['diagnostic','medicine'];
    public $fillable = ['date','diagnostic','medicine','doctor_id','invoice_id','patient_id'];

    public function Doctor(){
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
