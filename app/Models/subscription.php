<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subscription extends Model
{
    use HasFactory;
    protected $guarded=[];

    function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    function course(){
        return $this->belongsTo(course::class,'course_id');
    }
}
