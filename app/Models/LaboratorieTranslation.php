<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratorieTranslation extends Model
{
    use HasFactory;
    public $fillable = ['description'];
    public $timestamps = false;
}
