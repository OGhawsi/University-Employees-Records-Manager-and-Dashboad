<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faculty::factory(10)
            ->has(
                Department::factory(10)->each(
                    Employee::factory()->count(10), 'comments')
                ->count(5), 'articles')
            ->create();
    }
}
