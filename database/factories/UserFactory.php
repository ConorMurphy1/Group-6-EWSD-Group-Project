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
        return [
            'username' => 'admin-master',
            'firstname' => 'Super',
            'lastname' => 'Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('password'),
            'is_updated' => true,

            /** TODO: update department and role id after other team members completed their crud work */
            'department_id' => 1,
            'role_id' => 1,
        ];
    }
}
