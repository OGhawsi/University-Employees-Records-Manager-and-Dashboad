<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;

class UniversityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = University::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'name' => $this->faker->name(),
            'seats' => $this->faker->numberBetween(5,500),
            'email' => $this->faker->safeEmail(),
            'employee_id' =>$this->faker->numberBetween(1, 5),
            'established' => now(),
        ];
    }
}
