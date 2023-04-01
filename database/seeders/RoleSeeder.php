<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()->create([
            'role' => 'QA Manager'
        ]);
        Role::factory()->create([
            'role' => 'QA Coordinator'
        ]);
        Role::factory()->create([
            'role' => 'Admin'
        ]);
        Role::factory()->create([
            'role' => 'Staff'
        ]);
    }
}
