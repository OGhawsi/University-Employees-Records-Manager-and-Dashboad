<?php

namespace Database\Factories;

use App\Models\Rank;
use Illuminate\Database\Eloquent\Factories\Factory;

class RankFactory extends Factory
{
    /** 
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rank::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(['پوهاند',
                                            'پوهنوال',
                                            'پوهندوی',
                                            'پوهنمل',
                                            'پوهنیار',
                                            'نامزد پوهنیار',
                                            'بوهیالی'
                                        ]),
            'name_english' => $this->faker->unique()->randomElement(['Professor',
                                            'Assoc. Prof.',
                                            'Senior Assoc. Prof.',
                                            'Senior Assist. Prof.',
                                            'Assistant Prof.',
                                            'Teaching Assistant',
                                            'Instructor'
                                        ]),
            'academic_rank' => $this->faker->unique()->numberBetween(1, 7),
        ];
    }
}
