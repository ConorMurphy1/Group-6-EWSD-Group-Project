<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // return [
        //     'username' => 'admin-master',
        //     'firstname' => 'Admin',
        //     'lastname' => 'Master',
        //     'email' => 'admin@email.com',
        //     'password' => 'password',
        //     'is_updated' => true,

        //     /** TODO: update department */
        //     'department_id' => 1,
        //     'role_id' => 3,
        // ];

        return [
            'username' => $this->faker->userName(),
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'password',
            'is_updated' => true,
            'department_id' => $this->faker->numberBetween(1, 6),
            'role_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
