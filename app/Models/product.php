<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $table='products';
    function brand(){
        return $this->belongsTo(brand::class,'brand_id');
    }
    function category(){
        return $this->belongsTo(category::class,'category_id');
    }
    function coach(){
        return $this->belongsTo(coach::class,'coach_id');
    }
    function purchases(){
        return $this->hasMany(purchase::class,'supplement_id');
    }
    function colors(){
        return $this->hasMany(product_color::class,'supplement_id');
    }
    function sizes(){
        return $this->hasMany(product_size::class,'supplement_id');
    }

    function images(){
        return $this->hasMany(product_image::class,'supplement_id','id');
}
}
