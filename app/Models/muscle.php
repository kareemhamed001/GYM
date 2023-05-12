<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class muscle extends Model
{
    use HasFactory;
    protected $table='muscles';
    protected $guarded=[];

    public function curricula(){
        return $this->hasMany(curriculum::class);
    }
}
