<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FooterInfo>
 */
class FooterInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'logo' => $this->faker->imageUrl(),
            'description' => fake()->paragraph(),
            'copyright' => fake()->sentence(),
        ];
    }
}
