<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;
    
    const BACHELOR = 1; 
    const MASTERS = 2; 
    const PHD = 3; 
    
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
