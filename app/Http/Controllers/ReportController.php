<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Faculty;
use App\Models\Employee;
use App\Models\Department;
use App\Exports\EmployeesExport;


class ReportController extends Controller
{


    public function export()
    {
        return (new EmployeesExport)->download('employees.xlsx');
    }
    public function index()
    {
        $employee = Employee::query();
        
        return Inertia::render('Report/Index' , [
            'employees' => $employee->with(['degrees','ranks','employments','addresses', 'workingDepartment.faculty'])
                                    ->withFilters()->paginate(15),
            'employees_count' => $employee->count(),
            'faculties' => Faculty::all(), #usually less number of faculties in a university
            'departments' => Employee::getDepartments(),
        ]);
    }
}