<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Event;
use App\Models\Idea;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdeaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $event = Event::create([
            'name' => 'Halloween',
            'description' => 'Halloween fucking lit staff party',
            'closure' => Carbon::now()->addWeeks(2),
            'final_closure' => Carbon::now()->addMonth(),
        ]);

        Idea::factory(20)->create([
            'event_id' => $event->id,
        ]);

        Comment::factory(30)->create();
    }
}
