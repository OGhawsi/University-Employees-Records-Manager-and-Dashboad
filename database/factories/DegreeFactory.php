<?php

namespace Database\Factories;

use App\Models\Degree;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class DegreeFactory extends Factory
{
    /** 
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Degree::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'study_field' => $this->faker->randomElement(['science','art','engineering','IT', 'medicine', 'economic', 'sports', 'finance']),
            'study_field_english' => $this->faker->randomElement(['science','art','engineering','IT', 'medicine', 'economic', 'sports', 'finance']),
            'faculty' => $this->faker->randomElement(['kdr','kbl','delhi','pune']),
            'faculty_english' => $this->faker->randomElement(['engineering','science','medicine','education','arts','law','shreia','economics', 'computer IT']),
            'university' => $this->faker->randomElement(['kdr','kbl','delhi','pune']),
            'university_english' => $this->faker->randomElement(['kdr','kbl','delhi','pune']),
            'degree_name' => $this->faker->numberBetween(1,3),
            'country' => $this->faker->country(),
            'country_english' => $this->faker->country(),
            'start_date' => $this->faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null),
            'graduation_date' => $this->faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null),
            'current' => $this->faker->boolean(),
            'completed' => false,
        ];
    }
}
