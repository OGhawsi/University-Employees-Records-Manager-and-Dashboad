<?php
namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    // TODO: add casting to all the models

    protected $casts = [
        'other_languages' => 'array',
    ];

    public static $departments;

    const SINGLE = 1;
    const MARRIED = 2;
    const DIVORCED = 3;
    
    const MALE = 1;
    const FEMALE = 2;
    const OTHER = 3;

    // employee status
    const AVAILABLE = 1;
    const WORKING = 2;
    const STUDYING = 3;

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function workingDepartment()
    {
        return $this->belongsTo(Department::class, 'department_id','id');
    }
    
    public function headOfDepartment()
    {
        return $this->hasOne(Department::class);
    }

    public function deanOfFaculty()
    {
        return $this->hasOne(Faculty::class);
    }
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function degrees()
    {
        return $this->hasMany(Degree::class);
    }

    // many to many relationship
    public function ranks()
    {
        return $this->belongsToMany(Rank::class)
                    ->withPivot('id','subject_of_academic_research', 'registration_of_academic_research', 'completion_of_academic_research', 'current')
                    ->distinct();
    }

    public function employments()
    {
        return $this->hasMany(Employment::class);
    }

    public static function getDepartments()
    {
        return self::$departments;
    }
    
    public function scopeWithFilters($employee)
    {

        return $employee->when(request('is_working_outside'), function ($employee) {
                $employee->where('status', 2);
            })
            ->when(request('is_studying'), function ($employee) {
                $employee->where('status', 3);
            })
            ->when(request('is_due'), function($employee){
                $employee->whereHas('ranks', function($q) {
                    $q->where('rank_id', '!=', 1)
                        ->where('completion_of_academic_research', '=' , null)
                        ->where('registration_of_academic_research', '<=' , Carbon::today()->subYears(3));
                });
            })
            ->when(request('faculty'), function($employee) {
            
                self::$departments = Department::whereIn('faculty_id', request('faculty'))->get();
                $employee->whereIn('department_id', self::$departments->pluck('id'))->get();

            })
            ->when(request('academic_rank'), function($employee) {
                $employee->whereHas('ranks' , function($q) {
                    $q->whereIn('academic_rank', request('academic_rank'))
                        ->where('current', true);
                });
            })
            ->when(request('degree_name'), function($employee) {
                $employee->whereHas('degrees' , function($q) {
                    $q
                        ->where('current', true)
                        ->whereIn('degree_name', request('degree_name'));
                });
            })
            ->when(request('department') && request('faculty'), function($employee) {
                self::$departments = Department::whereIn('faculty_id', request('faculty'))->get();
                $employee->whereIn('department_id', request('department'));
            })
            ->when(request('age') , function($employee) {
                $age = request('age');
                $employee->when($age['start'] && !$age['end'], function($employee) use ($age) {
                    $startDate = Carbon::today()->subYears($age['start']);
                    $employee->where('date_of_birth', '<=', $startDate);
                })
                ->when($age['end'] && !$age['start'], function($employee) use ($age) {
                    $endDate = Carbon::today()->subYears($age['end']);
                    $employee->where('date_of_birth', '>=', $endDate);
                })
                ->when($age['end'] && $age['start'], function($employee) use ($age) {
                    $endDate = Carbon::today()->subYears($age['start']);
                    $startDate = Carbon::today()->subYears($age['end']);
                    $employee->whereBetween('date_of_birth', [$startDate, $endDate]);
                });
            })
            ->when(request('employment_date'), function($employee) {
                $employment_date = request('employment_date');
                $employee
                ->when($employment_date['start'] && $employment_date['end'] , function($employee) use ($employment_date) {
                    $employee->whereHas('employments' , function($q) use($employment_date) {
                        $q->whereBetween('employment_date',[ $employment_date['start'], $employment_date['end'] ]);
                    }); 
                })
                ->when($employment_date['start'] && !$employment_date['end'] , function($employee) use ($employment_date) {
                    $employee->whereHas('employments' , function($q) use($employment_date) {
                        $q->where('employment_date','>=', $employment_date['start']);
                    }); 
                })
                ->when(!$employment_date['start'] && $employment_date['end'] , function($employee) use ($employment_date) {
                    $employee->whereHas('employments' , function($q) use($employment_date) {
                        $q->where('employment_date','<=', $employment_date['end']);
                    }); 
                });
            });
            
    }
}
