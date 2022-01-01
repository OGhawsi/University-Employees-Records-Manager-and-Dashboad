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

    }
}
