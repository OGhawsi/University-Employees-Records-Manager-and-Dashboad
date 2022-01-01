<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Employment;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmploymentFactory extends Factory
{
    /** 
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rewards' => $this->faker->word(),
            'rewards_english' => $this->faker->word(),
            'penalties' => $this->faker->word(),
            'penalties_english' => $this->faker->word(),
            'post_title' => $this->faker->word(),
            'post_title_english' => $this->faker->word(),
            'post_code' => $this->faker->numberBetween(0,10),
            'designation' => $this->faker->randomElement(['teaching','dean','head','service_member']),
            'employment_letter_number' => $this->faker->numberBetween(1200,157892),
            'academic_rank' => $this->faker->numberBetween(1, 7),
            'employment_date' => $this->faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null),
            'completed' => false,
        ];
    }
}
