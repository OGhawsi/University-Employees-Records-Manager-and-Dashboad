<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Rank;
use Inertia\Inertia;
use App\Models\Faculty;
use App\Models\Employee;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacultyController extends Controller
{
    public function index(Faculty $faculty)
    {

        // load Dean of the faculty
        $faculty = $faculty->load('employee');

        $departments = Department::withCount('employees')->with('employee.addresses')->where('faculty_id', $faculty->id)->get();

        // load collection of employees for the next query condtion
        $employees = $faculty->employees->pluck('id');
  

       $academic_ranks = DB::table('employee_rank')
                        ->select( 'rank_id',
                            DB::raw('count(distinct employee_id) as total_employees'))
                        ->where('current', 1)
                        ->whereIn('employee_id', $employees)
                        ->groupBy('rank_id')
                        ->get();

        return Inertia::render('Faculty/Index' , [
           'faculty' => $faculty,
           'departments' => $departments,
           'academic_ranks' => $academic_ranks
        ]);
        
    }

    public function create()
    {
        // $universities = University::all(['id','name']);
        $term = request('term');
        return Inertia::render('Faculty/Create', [
            'employees' => Employee::where('first_name_english','Like', "%$term%")
                                    ->limit(8)
                                    ->get(['id','first_name_english', 'last_name_english']),
        ]);
    }
    public function store(Request $request)
    {
        Faculty::create(
            request()->validate([
                'name' => ['required','max:50','unique:faculties,name'],
                'email' => ['required','email', 'max:75','unique:faculties,email'],
                'established' => ['required','date'],
                'employee_id' => ['nullable', 'unique:faculties,employee_id', 'unique:departments,employee_id'],
                'university_id' => ['required'],
            ])
        );
        return redirect()->route('faculty.index', 1)
            ->with(['toast' => ['message' => 'Employment removed successfully']]);
    }

    public function edit(Faculty $faculty)
    {
        $universities = University::all(['id','name']);
        $term = request('term');
        $employees = [];

        if (request()->has('term')) {
            $employees = Employee::where('first_name_english','Like', "%$term%")
                ->orWhere('last_name_english', 'Like', "%$term%")
                ->limit(6)
                ->get(['id','first_name_english', 'last_name_english']);
        }
        return Inertia::render('Faculty/Edit', [
            'faculty' => [
                'id' => $faculty->id,
                'name' => $faculty->name,
                'email' => $faculty->email,
                'established' =>$faculty->established,
                'university_id' => $faculty->university_id,
                'employee_id' => $faculty->employee_id,
                'employee' => $faculty->employee,
            ],
            'employees' => $employees,
            'universities' => $universities,
        ]);
    }
    public function update(Request $request, Faculty $faculty)
    {
        $faculty->update(
            request()->validate([
                'name' => ['required','max:50', 'unique:faculties,name,'. $faculty->id],
                'email' => ['required','email', 'max:75'],
                'established' => ['required','date'],
                'employee_id' => ['nullable', 'unique:faculties,employee_id,'.$faculty->id, 'unique:departments,employee_id'],
                'university_id' => ['required'],
            ])
        );
        return redirect()->route('faculty.index', $faculty->id)
            ->with(['toast' => ['message' => 'Faculty updated successfully']]);
    }
    public function destroy(Faculty $faculty)
    {
        $faculty->delete();
        return redirect()->route('faculty.index', 1);
    }
}
