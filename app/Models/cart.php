<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function product(){
        return $this->belongsTo(product::class,'product_id','id');
    }
    public function color(){
        return $this->belongsTo(product_color::class,'color_id','id');
    }

    public function size(){
        return $this->belongsTo(product_size::class,'size_id','id');
    }
}
