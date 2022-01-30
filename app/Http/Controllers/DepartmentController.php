<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    public function create(Faculty $faculty)
    {
 
        $term = request('term');

        return Inertia::render('Department/Create', [
            'employees' => Employee::where('first_name_english','Like', "%$term%")
                                    ->limit(8)
                                    ->get(['id','first_name_english', 'last_name_english']),
            'faculty' => $faculty
        ]);
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => ['bail','required','max:50','unique:departments,name'],
            'email' => ['bail','required','email', 'max:75','unique:departments,email'],
            'established' => ['bail','required','date'],
            'employee_id' => ['bail','nullable', 'unique:departments,employee_id', 'unique:faculties,employee_id'],
            'faculty_id' => ['required'],
            'university_id' => ['required'],
        ]);
        
        Department::create($validated_data);
        return redirect()
                ->route('faculty.index', request('faculty_id'))
                ->with(['toast' => ['message' => 'Department added successfully']]);
    }

    public function edit(Department $department)
    {

        $faculty = Faculty::where('id',$department->faculty_id)->get(['id','name']);
      
        $term = request('term');

        $employees = [];

        if (request()->has('term')) {
            $employees = Employee::where('first_name_english','Like', "%$term%")
                ->orWhere('last_name_english', 'Like', "%$term%")
                ->limit(8)
                ->get(['id','first_name_english', 'last_name_english']);
        }
        
        return Inertia::render('Department/Edit', [
            'department' => [
                'id' => $department->id,
                'name' => $department->name,
                'email' => $department->email,
                'established' =>$department->established,
                'faculty_id' => $department->faculty_id,
                'university_id' => $department->university_id,
                'employee_id' => $department->employee_id,
                'employee' => $department->employee,
            ],
            'employees' => $employees,

            'faculty' => $faculty,
            
        ]);
    }

    public function update( Department $department)
    {
         
        $department->update(
            request()->validate([
                'name' => ['required','max:50', 'unique:departments,name,'.$department->id],
                'email' => ['required','email', 'max:75' , 'unique:departments,email,'.$department->id],
                'established' => ['required','date'],
                'employee_id' => ['nullable', 'unique:departments,employee_id,'.$department->id, 'unique:faculties,employee_id'],
                'faculty_id' => ['required'],
                'university_id' => ['required'],
            ])
        );

        return redirect()->route('faculty.index', request('faculty_id'))
            ->with(['toast' => ['message' => 'Department updated successfully']]);;
    }

    public function destroy(Department $department)
    {
        $faculty = $department->faculty_id;
        $department->delete();
        return redirect()->route('faculty.index', $faculty)
        ->with(['toast' => ['message' => 'Department removed successfully']]);
    }

    // public function search()
    // {
    //     $employee = Department::where('name','Like', '%'.request('term').'%')
    //     ->limit(4)
    //     ->get(['id','name']);
    //     return response()->json($employee);
    // }
}
