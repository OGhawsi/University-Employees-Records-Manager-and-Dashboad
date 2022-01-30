<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Inertia\Inertia;
use App\Models\Faculty;
use App\Models\Employee;
use App\Models\Employment;
use Illuminate\Http\Request;

class EmploymentController extends Controller
{

    public function create(Employee $employee)
    {
        return Inertia::render('Employment/Create', [
            'employee' => $employee ,
            'ranks' => Rank::all(),
        ]);
    }

    public function store(Employee $employee)
    {
        Employment::create(
            request()->validate([
                'employee_id' => ['max:255','required'],
                'rewards' => ['max:255'],
                'rewards_english' => ['max:255'],
                'penalties' => ['max:255'],
                'penalties_english' => ['max:255'],
                'post_title' => ['max:255'],
                'post_title_english' =>['required', 'max:255'],
                'post_code' =>['numeric', 'max:10'],
                'designation' =>['required'],
                'employment_letter_number' =>['numeric'],
                'academic_rank' =>['required'],
                'employment_date' =>['required','date'],
                'completed' => ['boolean'],
            ])
        );
        return redirect()->route('employee.show',$employee)
            ->with(['toast' => ['message' => 'Employment added successfully']]);

    }

    public function edit(Employment $employment)
    {
        return Inertia::render('Employment/Edit', [
            'employment' => $employment,
            'ranks' => Rank::all(),
            'employee' => $employment->employee
        ]);
    }

    public function update(Employment $employment)
    {

        $employment->update(
            request()->validate([
                'employee_id' => ['max:255','required'],
                'rewards' => ['max:255'],
                'rewards_english' => ['max:255'],
                'penalties' => ['max:255'],
                'penalties_english' => ['max:255'],
                'post_title' => ['max:255'],
                'post_title_english' =>['required', 'max:255'],
                'post_code' =>['numeric', 'max:10'],
                'designation' =>['required'],
                'employment_letter_number' =>['numeric'],
                'academic_rank' =>['required'],
                'employment_date' =>['required','date'],
                'completed' => ['boolean'],
            ])
        );
        return redirect()->route('employee.show',$employment->employee_id)
            ->with(['toast' => ['message' => 'Employment updated successfully']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employment  $employment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employment $employment)
    {
        $employee = $employment->employee_id;
        $employment->delete();
        return redirect()->route('employee.show', $employee)
            ->with(['toast' => ['message' => 'Employment removed successfully']]);
    }
}
