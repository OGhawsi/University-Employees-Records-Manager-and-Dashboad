<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rank;
use Inertia\Inertia;
use App\Models\Faculty;
use App\Models\Employee;
use App\Models\Department;
use App\Models\University;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $total_employees = Employee::count();

        $employees = Employee::all();

        $faculties = Faculty::withCount('employees')->with('employee.addresses')->get();

        // TODO: get the employees whose rank is due 
        $employee_rank_due = Employee::whereHas('ranks', function($q) {
            $q->where('rank_id', '!=', 1)
            ->where('completion_of_academic_research', '=' , null)
            ->where('registration_of_academic_research', '<' , Carbon::today()->subYears(3));
        })->get();

        $total_faculties = Faculty::count();

        $total_departments = Department::count();

        $total_seats = University::where('id','=', 1)->first('seats');

        $academic_ranks= DB::table('employee_rank')
                            ->select( 'rank_id',
                                DB::raw('count(distinct employee_id) as total_employees'))
                            ->where('current', 1)
                            ->groupBy('rank_id')
                            ->get();

   
        $available_employees = Employee::where('status','=', 1)->count();

        $is_studying = Employee::where('status', 2)->count();

        $is_working_outside = Employee::where('status', 3)->count();
        
        return Inertia::render('Dashboard/Index', [
            'total_employees' => $total_employees,
            'employees' => $employees,
            'total_faculties' =>$total_faculties,
            'total_departments' =>$total_departments,
            'total_seats' =>$total_seats,
            'academic_ranks' =>$academic_ranks,
            'available_employees' =>$available_employees,
            'is_studying' =>$is_studying,
            'is_working_outside' =>$is_working_outside,
            'faculties' =>$faculties,
            'ranks' =>Rank::paginate(7),
            'employee_rank_due' =>$employee_rank_due,
        ]);
    }
}
