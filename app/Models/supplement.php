<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplement extends Model
{
    use HasFactory;
    protected $guarded=[];

    function brand(){
        return $this->belongsTo(brand::class,'brand_id');
    }
    function coach(){
        return $this->belongsTo(coach::class,'coach_id');
    }
    function purchases(){
        return $this->hasMany(purchase::class,'supplement_id');
    }

    function images(){
        return $this->hasMany(product_image::class,'supplement_id','id');
}
}
