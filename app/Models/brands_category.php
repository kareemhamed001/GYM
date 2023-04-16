<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brands_category extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function category(){
        return $this->belongsTo(category::class,'category_id','id');
    }
    public function brand(){
        return $this->belongsTo(brand::class,'brand_id','id');
    }
}
