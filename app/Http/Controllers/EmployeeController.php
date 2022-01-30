<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Faculty;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email,established,employee_id'],
        ]);

        $query = Employee::query();

        if (request('employee_search')) {
            $query->where('first_name_english', 'LIKE','%'.request('employee_search').'%')
                    ->orWhere('last_name_english', 'LIKE','%'.request('employee_search').'%');
        }

        return Inertia::render('Employee/Index', [
            'employees' => $query->with(['workingDepartment.faculty', 'addresses'])->paginate(10)
        ]);
    }

    public function create()
    {
        $faculties = Faculty::all(['id','name']);

        $departments = [];

        if (request('relatedDepartment')) {
            $departments = Department::where('faculty_id', '=',  request('relatedDepartment'))->get(['id','name']);
        }

        return Inertia::render('Employee/Create', [
            'faculties' => $faculties,
            'departments' => $departments
        ]);
    }

    public function store(Request $request)
    {
        $employee = Employee::create(
             request()->validate([
                'department_id' => ['max:32','required'],
                'university_id' => ['max:32'],
                'first_name' =>['max:255'],
                'first_name_english' =>['max:255', 'required'],
                'last_name' =>['max:255'],
                'last_name_english' =>['max:255', 'required'],
                'father_name' =>['max:255'],
                'father_name_english' =>['max:255', 'required'],
                'grandfather_name' =>['max:255'],
                'grandfather_name_english' =>['max:255', 'required'],
                'id_tazkira' =>['unique:employees,id_tazkira','max:255', 'required'],
                'passport_number' =>['unique:employees,passport_number','max:255', 'nullable'],
                'gender' =>['max:1','required'],
                'date_of_birth' =>['max:255', 'required'],
                'nationality' =>['max:255'],
                'nationality_english' =>['max:255', 'required'],
                'marital_status' =>['required'],
                'native_language' =>['max:255','required'],
                'other_languages' =>['max:255'],
                'profile_photo_path' =>['nullable'],
                'status' => ['required'],
               
             ])
         );
         return redirect()
                ->route('employee.show', $employee)
                ->with(['toast' => ['message' => 'Employee added successfully']]);
       
    }


    public function show(Employee $employee)
    {

        return Inertia::render('Employee/Show', [
            'employee' => $employee,
            'deanOfFaculty' => $employee -> deanOfFaculty,
            'workingDepartment' => $employee->workingDepartment->load('faculty'),
            'headOfDepartment' => $employee -> headOfDepartment,
            'degrees' => $employee -> degrees,
            'addresses' => $employee -> addresses,
            'employments' => $employee -> employments,
            'attachments' => $employee -> attachments,
            'ranks' => $employee->ranks,
        ]);
    }

    public function edit(Employee $employee)
    {

        // $faculties = Faculty::all(['id','name']);

        $departments = Department::where('faculty_id', '=',  $employee->workingDepartment->faculty->id)->get(['id','name']);
 
        // if (request('relatedDepartment')) {
        //     $departments = Department::where('faculty_id', '=',  request('relatedDepartment'))->get(['id','name']);
        // }
    
        return Inertia::render('Employee/Edit', [
            // 'faculties' => $faculties,
            'departments' => $departments,
            'employee' => $employee
        ]);
    }

 
    public function update(Request $request, Employee $employee)
    {
        $employee -> update(
            request()->validate([
                'department_id' => ['max:32','required'],
                'university_id' => ['max:32'],
                'first_name' =>['max:255'],
                'first_name_english' =>['max:255', 'required'],
                'last_name' =>['max:255'],
                'last_name_english' =>['max:255', 'required'],
                'father_name' =>['max:255'],
                'father_name_english' =>['max:255', 'required'],
                'grandfather_name' =>['max:255'],
                'grandfather_name_english' =>['max:255', 'required'],
                'id_tazkira' =>['unique:employees,id_tazkira,'.$employee->id,'max:255', 'required'],
                'passport_number' =>['unique:employees,passport_number,'.$employee->id,'max:255', 'nullable' ],
                'gender' =>['max:1','required'],
                'date_of_birth' =>['max:255', 'required'],
                'nationality' =>['max:255'],
                'nationality_english' =>['max:255', 'required'],
                'marital_status' =>['required'],
                'native_language' =>['max:255','required'],
                'other_languages' =>['max:255'],
                'profile_photo_path' =>['nullable'],
                'status' => ['required'],
            ])
        );
        return redirect()->route('employee.show', $employee)
            ->with(['toast' => ['message' => 'Employee updated successfully']]);
    }


    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employee.index');
    }

    public function addAvatar(Employee $employee)
    {
        if ($employee->profile_photo_path) {
            Storage::delete($employee->profile_photo_path);
        }
        request()->validate([
            'file' => ['file', 'max:10240', 'mimes:jpg,jpeg,png,bmp,tiff']
        ], [
            'max' => 'File can not be larger than 10MB',
            'mimes' => 'Upload images only'
        ]);

        $file = request()->file('file');
        $file_name = time().'_'.$file->getClientOriginalName();
        $dir = "public/attachments/{$employee->id}";
        $path = $file->storeAs($dir, $file_name);

        $preview_url = url("storage/attachments/{$employee->id}/$file_name"); 
        
        $employee->update([
            'profile_photo_url' => $preview_url,
            'profile_photo_path' => $path,
        ]);

        return redirect()->back();
    }
    public function removeAvatar(Employee $employee)
    {
        Storage::delete($employee->profile_photo_path);
        
        $employee->update([
            'profile_photo_url' => null,
            'profile_photo_path' => null,
        ]);
        return redirect()->back()
        ->with(['toast' => ['message' => 'Employee removed successfully']]);
    }
   
}
