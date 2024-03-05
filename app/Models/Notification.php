<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    public $fillable = ['render_status','message','email'];

    public function scopeCountNotification($query,$username){
       return $query->where('render_status',0)->where('user_id',$username);
    }

}
