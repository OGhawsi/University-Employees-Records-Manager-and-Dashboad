<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /** 
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'first_name' => $this->faker->firstName(),
            'first_name_english' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'last_name_english' => $this->faker->lastName(),
            'father_name' => $this->faker->name(),
            'father_name_english' => $this->faker->name(),
            'grandfather_name' => $this->faker->name(),
            'grandfather_name_english' => $this->faker->name(),
            'id_tazkira' => $this->faker->swiftBicNumber(),
            'passport_number' => $this->faker->swiftBicNumber(),
            'gender' => 1,
            'date_of_birth' => $this->faker->dateTimeBetween($startDate = '-60 years', $endDate = '-20 years', $timezone = null),
            'nationality' => $this->faker->country(),
            'nationality_english' => $this->faker->country(),
            'marital_status' => 1,
            'native_language' => $this->faker->languageCode(),
            'profile_photo_path' => 'image.png',
            'status' => $this->faker->randomElement([1,2,3]),
        ];
    }
}
