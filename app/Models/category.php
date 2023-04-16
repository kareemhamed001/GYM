<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function brands(){
        return $this->belongsToMany(brand::class,'brands_categories','brand_id','id');
    }
}
