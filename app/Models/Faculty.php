<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    
    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function employees()
    {
        return $this->hasManyThrough(Employee::class, Department::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id','id');
    }
}
