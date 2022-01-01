<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Faculty;
use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = Employee::all('id');

        $ranks = \App\Models\Rank::factory(7)->create();
        
        $employees->each(function (Employee $r) use ($ranks) {
            $r->ranks()->attach(
                $ranks->random(rand(1, 3))->pluck('id')->toArray(),
                [
                    'subject_of_academic_research' => 'example research topic...',
                    'current' => $r->id % 2 == 0? 1 : 0 ,
                ],
            );
        });


    }
}
