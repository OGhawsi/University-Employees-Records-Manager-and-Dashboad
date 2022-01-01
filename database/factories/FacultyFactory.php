<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacultyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Faculty::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'employee_id' => Employee::factory()->create(),
            'university_id' => 1,
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'established' =>  $this->faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null),
        ];
    }
}
