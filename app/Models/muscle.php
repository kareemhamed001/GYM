<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class muscle extends Model
{
    use HasFactory;
    protected $table='muscles';
    protected $guarded=[];


    public function parts(){
        return $this->hasMany(part::class,'muscle_id','id');
    }

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::created(function ($muscle){
            \Log::info('new muscle with id '.$muscle->id.' stored');
        });
    }
}
