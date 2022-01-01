<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    const PERMANENT_ADDRESS = 1;
    const CURRENT_ADDRESS = 2;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
