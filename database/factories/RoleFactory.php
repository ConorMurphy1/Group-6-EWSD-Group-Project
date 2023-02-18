<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    // protected static $roles = ['Admin', 'QA Manager', 'QA Coordinator', 'Staff'];
    // protected static $increment = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'role' => static::$roles[static::$increment++],
            'role' => fake()->unique()->word()
        ];
    }
}
