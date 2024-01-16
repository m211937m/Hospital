<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FondAccount extends Model
{
    use HasFactory;
    public $fillable = ['date','single_invoice_id','receip_id','Dabit','credit'];
}
