<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RayTranslation extends Model
{
    use HasFactory;

    public $fillable = ['descriptio'];
    public $timestamps = false;
}
