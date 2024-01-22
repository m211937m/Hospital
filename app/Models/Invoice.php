<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public $fillable = ['invoice_type','date','patient_id','doctor_id','section_id','service_id','group_id','price','discount_value','tax_rate','tax_value','total_with_tax','type','invoice_status'];

    public function Service(){
        return $this->belongsTo(Service::class ,'service_id');
    }
    public function Group(){
        return $this->belongsTo(Group::class, 'group_id');
    }
    public function Section(){
        return $this->belongsTo(Section::class , 'section_id');
    }
    public function Doctor(){
        return $this->belongsTo(Doctor::class ,'doctor_id');
    }
    public function Patient(){
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
