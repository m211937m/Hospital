<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticTranslation extends Model
{

    use HasFactory;
    public $fillable=['diagnostic','medicine'];
    public $timestamps = false;
}
