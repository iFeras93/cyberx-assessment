<?php

namespace Database\Factories;

use App\Models\User;
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
            'task_type' => $this->faker->randomElement(['assessment', 'survey']),
            'progress' => $this->faker->numberBetween(0, 100),
            'score' => $this->faker->numberBetween(50, 100),
            'user_id' => User::factory(), // Assign to a user
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
