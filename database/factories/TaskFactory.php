<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'         => fake()->words(asText: true),
            'is_completed' => fake()->boolean(),
            'due_date'     => fake()->dateTimeBetween('now', '+1 month'),
            'created_at'   => fake()->dateTimeBetween(now()->startOfWeek(), now()->endOfWeek()),
        ];
    }
}
