<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Department::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'faculty_id' => $this->faker->randomDigitNotZero(),
            // 'employee_id' => Employee::factory()->create(),
            'university_id' => 1,
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'established' =>  $this->faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null),
        ];
    }
}
