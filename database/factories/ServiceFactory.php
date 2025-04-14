<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'type' => $this->faker->randomElement(['quick','long']),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'image' =>  null , // or use $this->faker->imageUrl()
            'period' => $this->faker-> numberBetween(30,365)
        ];
    }
}
