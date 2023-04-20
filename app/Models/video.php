<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    use HasFactory;
    protected $guarded=[];

    function coach(){
        return $this->belongsTo(coach::class,);
    }

    function courses(){
        return $this->belongsToMany(course::class,'courses_videos');
    }
}
