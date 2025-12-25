<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Einsatz>
 */
class EinsatzFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(4);

        return [
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title),
            'description' => fake()->optional()->paragraph(),
            'body' => fake()->paragraphs(3, true),
            'timestamp' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
