<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courses_video extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function videos(){
        return $this->belongsTo(video::class,'video_id','id');
    }

    public function course(){
        return $this->belongsTo(course::class,'course_id','id');
    }
}
