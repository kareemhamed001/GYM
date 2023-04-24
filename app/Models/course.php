<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function coach(){
        return $this->belongsTo(coach::class,'coach_id','id');
    }
    public function videos(){
        return $this->belongsToMany(video::class,'courses_videos','video_id','course_id','id');
    }
}
