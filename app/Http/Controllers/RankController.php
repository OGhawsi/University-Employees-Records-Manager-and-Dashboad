<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Inertia\Inertia;
use App\Models\Employee;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class RankController extends Controller
{
 
    public function create(Employee $employee)
    {
        return Inertia::render('Rank/Create', [
            'employee' => $employee ,
            'ranks' => Rank::all(),
        ]);
    }

    public function store(Employee $employee)
    {
        // update the previous ranks not to be the current one only if the new rank is
        // achieved by the completion date. 

        if (request('completion_of_academic_research')) {
            DB::table('employee_rank')
            ->where('employee_id', '=', $employee->id)
            ->update(['current' => 0]);
        }
        

        $data = request()->validate([
            'rank_id' => [
                Rule::unique('employee_rank')->where(function ($query) use($employee) {
                    return $query
                            ->where('rank_id', request('rank_id'))
                            ->where('employee_id', $employee->id );
                }),
            ],
            'subject_of_academic_research' => ['max:255'], 
            'registration_of_academic_research' => ['date', 'nullable'],
            'completion_of_academic_research' => ['date', 'nullable'] ,
            'current' => request('completion_of_academic_research') ? true : false,
        ]);

        $employee->ranks()->attach(request('rank_id'), $data);
       
        return redirect()->route('employee.show',$employee)
            ->with(['toast' => ['message' => 'Rank added successfully']]);
    
    }

    public function edit(Employee $employee, $pivot_id)
    {
        $rank = DB::table('employee_rank')->where('id','=', $pivot_id)->first();

        return Inertia::render('Rank/Edit', [
            'employee' => $employee,
            'rank' => $rank,
            'ranks' => Rank::all(),
        ]);
    }

    public function update(Employee $employee)
    {
        // update the previous ranks not to be the current one only if the new rank is
        // achieved by the completion date. 

        $data = request()->validate([
            'subject_of_academic_research' => ['required','max:255'], 
            'registration_of_academic_research' => ['date', 'nullable'],
            'completion_of_academic_research' => ['date', 'nullable'] ,
        ]);

        if (request('same_rank_id') != request('changed_rank_id')) {
            request()->validate([
                'changed_rank_id' => ['unique:employee_rank,employee_id,rank_id']
            ], ['unique' => 'Rank can not be changed, you can delete & add new one!']);
            request()->validate([
                'same_rank_id' => ['unique:employee_rank,employee_id,rank_id']
            ], ['unique' => 'Rank can not be changed, you can delete & add new one!']);
        }
       
        DB::table('employee_rank')->where('employee_id', $employee->id)
                                        ->where('rank_id', request('same_rank_id'))
                                        ->update(['rank_id' => request('changed_rank_id')]);
    
        DB::table('employee_rank')->where('employee_id', $employee->id)
                                         ->where('rank_id', request('same_rank_id'))
                                         ->update($data);
                                        
        return redirect()->route('employee.show',$employee->id)
            ->with(['toast' => ['message' => 'Rank updated successfully']]);
    
    }

    public function destroy($pivot)
    {
        //  set the second top rank as the current rank first and then delete this one
        // TODO: solve this problem after notification component. 
        // Current rank should not be deletable 
        // change the current rank tag first then delete
      
        DB::table('employee_rank')->where('id', $pivot)->delete();
        return redirect()->route('employee.index')
            ->with(['toast' => ['message' => 'Rank removed successfully']]);
    }

    public function addRank()
    {
        return Inertia::render('Rank/RankName/Create');
    }
    public function editRank(Rank $rank)
    {
        return Inertia::render('Rank/RankName/Edit', [
            'rank' => $rank
        ]);
    }
    public function storeRank()
    {
        Rank::create(
            request()->validate([
                'name' => ['required', 'max:255'],
                'name_english' => ['required', 'max:255'],
                'academic_rank' => ['required', 'max:10'],
            ])
        );
       return redirect()->route('dashboard');
    }
    public function updateRank(Rank $rank)
    {
        $rank->update(
            request()->validate([
                'name' => ['required', 'max:255'],
                'name_english' => ['required', 'max:255'],
                'academic_rank' => ['required', 'max:10'],
            ])
        );
       return redirect()->route('dashboard');
    }
    public function destroyRank(Rank $rank)
    {
        $rank->delete();
        return redirect(route('dashboard'))
            ->with(['toast' => ['message' => 'Rank removed successfully']]);
    }
}
