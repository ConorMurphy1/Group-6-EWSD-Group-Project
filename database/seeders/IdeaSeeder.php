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

        $event2 = Event::create([
            'name' => 'Valentine\'s',
            'description' => 'For all the FAs out there',
            'closure' => Carbon::createFromDate(2023, 2, 9),
            'final_closure' => Carbon::createFromDate(2023, 2, 13),
        ]);

        Idea::factory(5)->create([
            'event_id' => $event->id,
        ]);

        Idea::factory(5)->create([
            'event_id' => $event2->id,
        ]);

        Comment::factory(20)->create();
    }
}
