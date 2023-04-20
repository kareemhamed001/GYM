<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchase extends Model
{
    use HasFactory;
    protected $guarded=[];

    function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    function supplement(){
        return $this->belongsTo(supplement::class,'supplement_id','id');
    }
}
