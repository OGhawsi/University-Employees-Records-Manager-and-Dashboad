<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DegreeController extends Controller
{
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Employee $employee)
    {
        return Inertia::render('Degree/Create', [
            'employee' => $employee,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Employee $employee)
    {

         Degree::where('employee_id' , $employee->id)
                ->where('current', true)
                ->update(['current' => false]);
        Degree::create(
            request()->validate([
               'employee_id' => ['max:255','required'],
               'study_field' => ['max:255'],
               'study_field_english' => ['max:255','required' ],
               'university' =>['max:255'],
               'university_english' =>['max:255', 'required'],
               'faculty' =>['max:255'],
               'faculty_english' =>['max:255','required'],
               'degree_name' =>['max:255','required'],
               'country' =>['max:255'],
               'country_english' =>['max:255','required'],
               'start_date' =>['max:255', 'required'],
               'graduation_date' =>['max:255', 'required'],
               'completed' =>['max:255'],
               
            ])
        );
        return redirect()
                ->route('employee.show',$employee)
                ->with(['toast' => ['message' => 'Degree added successfully']]);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function edit(Degree $degree)
    {
        return Inertia::render('Degree/Edit', [
            'degree' => $degree,
            'employee' => $degree->employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Degree $degree)
    {
        $degree->update(
            request()->validate([
                'employee_id' => ['max:255','required'],
                'study_field' => ['max:255'],
                'study_field_english' => ['max:255','required' ],
                'university' =>['max:255'],
                'university_english' =>['max:255', 'required'],
                'faculty' =>['max:255'],
                'faculty_english' =>['max:255','required'],
                'degree_name' =>['max:255','required'],
                'country' =>['max:255'],
                'country_english' =>['max:255','required'],
                'start_date' =>['max:255', 'required'],
                'graduation_date' =>['max:255', 'required'],
                'completed' =>['max:255'],
               
            ])
        );
        return redirect()->route('employee.show',request('employee_id'))
            ->with(['toast' => ['message' => 'Degree updated successfully']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function destroy(Degree $degree)
    {
        $id = $degree->employee_id;
        $degree->delete();
        return redirect()->route('employee.show', $id)
                ->with(['toast' => ['message' => 'Degree removed successfully']]);
    }
}
