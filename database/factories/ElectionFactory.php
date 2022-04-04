<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ElectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->paragraphs(2, true),
            'public' => true,
            'anonymous' => true,
            'start_at' => now(),
            'end_at' => now(),
        ];
    }
}
