<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class single_invoices extends Model{
    use HasFactory;
    public $fillable = ['date','patient_id','doctor_id','section_id','service_id','price','discount_value','tax_rate','tax_value','total_with_tax','type'];


    public function Service(){
        return $this->belongsTo(Service::class);
    }
    public function Section(){
        return $this->belongsTo(Section::class);
    }
    public function Doctor(){
        return $this->belongsTo(Doctor::class);
    }
    public function Patient(){
        return $this->belongsTo(Patient::class);
    }


}
