<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coach extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function supplements(){
        return $this->hasMany(supplement::class,'coach_id','id');
    }
    public function brands(){
        return $this->hasMany(brand::class,'coach_id','id');
    }
    public function videos(){
        return $this->hasMany(video::class,'coach_id','id');
    }
    public function courses(){
        return $this->hasMany(course::class,'coach_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
