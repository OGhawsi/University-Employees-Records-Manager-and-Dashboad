<?php
namespace Database\Seeders;

use App\Models\Degree;
use App\Models\Address;
use App\Models\Employee;
use App\Models\Attachment;
use App\Models\Department;
use App\Models\Employment;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
 
    public function run()
    {
      
        \App\Models\Faculty::factory(10)
            ->has(
                Department::factory()->has(
                    Employee::factory()->has(
                            Attachment::factory()->count(2), 'attachments'
                        )->has(
                            Address::factory()->count(2), 'addresses'
                        )->has(
                            Degree::factory()->count(2), 'degrees'
                        )->has(
                            Employment::factory()->count(2), 'employments'
                        )->count(10), 'employees')
                ->count(5), 'departments')
            ->create();

            // Academic Ranks Seeder
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
