<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $department = Department::factory(1)->create([
            'name' => 'Department of Administration'
        ]);
        
        User::factory(1)->create([
            'department_id' => $department->first()->id,
            'role_id' => 3,
        ]);

        $this->call([
            DepartmentSeeder::class,
            UserSeeder::class,
            IdeaSeeder::class,
            RoleSeeder::class,
            CategorySeeder::class,
        ]);
    }
}
