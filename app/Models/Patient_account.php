<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient_account extends Model
{
    use HasFactory;
    public $fillable = ['date','patient_id','single_invoice_id','Dabit','credit'];
}
