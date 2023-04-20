<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function coach(){
        return $this->belongsTo(coach::class,'coach_id','id');
    }
    public function supplements(){
        return $this->hasMany(supplement::class,'brand_id','id');
    }
    public function categories(){
        return $this->belongsToMany(category::class,'brands_categories','brand_id','category_id');
    }

}
