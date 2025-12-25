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
        $year = fake()->year();
        $number = fake()->numberBetween(1, 999);
        $einsatznummer = "{$number}/{$year}";

        // Generate slug: {part1}-{part2}-{title-slug}
        $slug = "{$number}-{$year}-".\Illuminate\Support\Str::slug($title);

        return [
            'einsatznummer' => $einsatznummer,
            'title' => $title,
            'slug' => $slug,
            'description' => fake()->optional()->paragraph(),
            'body' => fake()->paragraphs(3, true),
            'timestamp' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
