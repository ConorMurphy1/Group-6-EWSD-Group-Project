<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Academic Programs',
            'Student Life',
            'Campus Infrastructure',
            'Faculty Development',
            'Research and Innovation',
            'Community Outreach',
            'Sustainability',
            'Technology and Digital Transformation',
            'Diversity, Equity, and Inclusion',
            'Health and Wellness',
            'Athletics and Sports Programs',
            'Student Recruitment and Retention',
            'Fundraising and Development',
            'Alumni Engagement',
        ];

        foreach ($categories as $category) {
            Category::factory()->create([
                'name' => $category,
            ]);
        }
    }
}
