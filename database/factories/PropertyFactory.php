<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->words(20,true),
            'price' => $this->faker->randomFloat(2, 100.0, 1000.0),
            'realtor_id' => $this->faker->numberBetween(1,10),
            'category_id' => $this->faker->numberBetween(1,10),
            'name' => $this->faker->words(5,true)
        ];
    }
}
