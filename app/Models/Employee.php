<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function departament(){
        return $this->belongsTo(\App\Models\Departament::class);
    }
    public function access(){
        return $this->hasMany(\App\Models\Access::class);
    }
}
