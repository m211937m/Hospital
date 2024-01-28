<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ray extends Model
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['descriptio'];
    public $fillable = ['date','descriptio','doctor_id','invoice_id','patient_id'];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
}
