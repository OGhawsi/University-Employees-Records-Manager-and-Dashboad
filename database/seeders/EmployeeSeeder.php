<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Employee::factory(100)->create();
    //     for ($i=0; $i < 100; $i++) { 
    //         $emp = \App\Models\Employee::factory()->create();
    //         $rank = \App\Models\Rank::factory()->create();

    //         DB::table('employee_rank')->insert([
    //             'employee_id' => $emp->id,
    //             'rank_id' => $rank->id,
    //             'subject_of_academic_research' => 'research topic...',
    //         ]);
    //    }
    }
}
