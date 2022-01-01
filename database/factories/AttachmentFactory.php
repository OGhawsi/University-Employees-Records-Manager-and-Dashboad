<?php

namespace Database\Factories;

use App\Models\Attachment;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttachmentFactory extends Factory
{
    /** 
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attachment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'type' => $this->faker->word(),
            'size' => $this->faker->randomDigit(),
            'path' => $this->faker->word(),
            'preview_url' => $this->faker->word(),
            'completed' => false,
        ];
    }
}
