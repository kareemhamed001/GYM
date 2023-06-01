<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class part extends Model
{
    use HasFactory;
    protected $guarded=[];
    function files(){
        return $this->hasMany(part_file::class,'part_id','id');
    }
}
