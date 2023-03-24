<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Idea>
 */
class IdeaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(),
            'image' => 'images/test.png',
            'description' => fake()->paragraph(),
            'user_id' => rand(1,4),
            'department_id' => rand(1,5),
            'event_id' => 1,
            'closure_date' => Carbon::now()->addMonth()
        ];
    }
}
