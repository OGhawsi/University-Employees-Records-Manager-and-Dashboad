<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;

    public $timestamps = false;

    const PROFESSOR = 7; // پوهاند
    const SENIOR_ASSOCIATE_PROFESSOR = 6; // بوهنوال
    const ASSOCIATE_PROFESSOR = 5; // پوهندوی
    const SENIOR_ASSISTANT_PROFESSOR = 4;// بوهنمل
    const ASSISTANT_PROFESSOR = 3; // بوهنیار
    const Instructor = 2; // ن پوهنیار  
    const TEACHING_ASSISTANT = 1; // پوهیالی  
    
    public function employees()
    {
        return $this->belongsToMany(Employee::class)
                    ->withPivot('id','subject_of_academic_research', 'registration_of_academic_research', 'completion_of_academic_research', 'current')
                    ->distinct()
                    ->wherePivot('current', 1);
    }
}
