<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Section extends Model
{
    use Translatable;
    protected $fillable =['name','description'];
    public $translatedAttributes =['name','description'];
    use HasFactory;

    public function doctors(){
        return $this->hasMany(Doctor::class);
    }

}
