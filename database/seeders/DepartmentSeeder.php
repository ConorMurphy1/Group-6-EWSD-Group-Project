<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::factory()->create([
            'name' => 'Department of Computer Science',
            'description' => 'Focuses on the theoretical and practical aspects of computer science, including algorithms, data structures, programming languages, software engineering, and computer architecture',
        ]);
        
        Department::factory()->create([
            'name' => 'Department of Computer Engineering',
            'description' => 'Focuses on the design and development of computer hardware and software systems, including computer networks, embedded systems, robotics, and digital signal processing',
        ]);
        
        Department::factory()->create([
            'name' => 'Department of Information Technology',
            'description' => 'Focuses on the use of technology to manage and process information, including database management, web development, systems analysis, and project management',
        ]);
        
        Department::factory()->create([
            'name' => 'Department of Cybersecurity',
            'description' => 'Focuses on protecting computer systems and networks from unauthorized access, attacks, and data breaches. This includes topics such as cryptography, network security, ethical hacking, and digital forensics',
        ]);
        
        Department::factory()->create([
            'name' => 'Department of Artificial Intelligence',
            'description' => 'Focuses on the development of intelligent computer systems that can learn, reason, and make decisions. This includes topics such as machine learning, natural language processing, computer vision, and robotics',
        ]);
    }
}
