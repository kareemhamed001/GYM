<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class curriculum extends Model
{
    use HasFactory;
    protected $guarded=[];
    function files(){
        return $this->hasMany(curriculum_file::class,'curriculum_id','id');
    }
}
