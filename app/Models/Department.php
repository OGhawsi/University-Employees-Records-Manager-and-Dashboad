<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }


    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id','id');
    }
}
