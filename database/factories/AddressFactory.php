<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /** 
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
'contact_no' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'province' => $this->faker->word(),
            'province_english' => $this->faker->word(),
            'address_type' => 1,
            'street_address' => $this->faker->streetAddress(),
            'street_address_english' => $this->faker->streetAddress(),
            'completed' => false,
        ];
    }
}
