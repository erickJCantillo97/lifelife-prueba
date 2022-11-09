<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function employeeObject()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }
}
