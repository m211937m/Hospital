<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab_empTranslation extends Model
{

    use HasFactory;
    public $fillable = ['name'];
    public $timestamps = false;
}
