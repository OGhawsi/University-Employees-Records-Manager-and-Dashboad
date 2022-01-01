<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    // protected $guarded = [];

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }


    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }


}
