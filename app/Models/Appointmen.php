<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointmen extends Model
{
    use HasFactory;
    public function section(){
        return $this->belongsTo(Section::class);
    }
    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
}
