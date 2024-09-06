<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\app\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Task\app\Models\Task>
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
        $user = User::query()->inRandomOrder()->first();
        return [
            'user_id' => $user->id,
            'title' => fake()->name(),
            'description' => fake()->text(),
            'completed' => fake()->boolean(),
            'deadline' => fake()->dateTime(),
        ];
    }
}
