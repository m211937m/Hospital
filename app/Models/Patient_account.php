<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient_account extends Model
{
    use HasFactory;
    public $fillable = ['date','patient_id','single_invoice_id','Dabit','credit'];

    public function invoice(){
        return $this->belongsTo(single_invoices::class,'single_invoice_id');
    }
    public function ReceiptAccount(){
        return $this->belongsTo(RecipAccount::class,'receip_id');
    }
    public function PaymentAccount(){
        return $this->belongsTo(PaymentAccounts::class,'payment_id');
    }
    // public function (){
    //     return $this->belongsTo(PaymentAccounts::class,'payment_id');
    // }
}
