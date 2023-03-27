<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'username' => 'admin-master',
            'firstname' => 'Admin',
            'lastname' => 'Master',
            'email' => 'admin@email.com',
            'password' => 'password',
            'is_updated' => true,
            'department_id' => 1,
            'role_id' => 3,
            'image' => 'test.png',
        ]);
        User::factory()->create([
            'username' => 'qa-manager',
            'firstname' => 'QA',
            'lastname' => 'Manager',
            'email' => 'qamanager@email.com',
            'password' => 'password',
            'is_updated' => true,
            // 'department_id' => 1,
            'role_id' => 1,
        ]);
        User::factory()->create([
            'username' => 'qa-coordinator',
            'firstname' => 'QA',
            'lastname' => 'Coordinator',
            'email' => 'qacoordinator@email.com',
            'password' => 'password',
            'is_updated' => true,
            // 'department_id' => 1,
            'role_id' => 2,
        ]);
        User::factory()->create([
            'username' => 'johndoe',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'johndoe@email.com',
            'password' => 'password',
            'is_updated' => true,
            'department_id' => 1,
            'role_id' => 4,
        ]);
    }
}
