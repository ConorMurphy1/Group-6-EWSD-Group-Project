<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Event;
use App\Models\User;
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
            'description' => 'Halloween incredibly lit staff party',
            'closure' => Carbon::now()->addWeeks(2),
            'final_closure' => Carbon::now()->addMonth(),
        ]);

        $event2 = Event::create([
            'name' => 'Valentine\'s',
            'description' => 'For all the FAs out there',
            'closure' => Carbon::createFromDate(2023, 2, 9),
            'final_closure' => Carbon::createFromDate(2023, 2, 13),
        ]);

        // Get users to exclude by their roles
        $excludedRoles = ['QA Manager', 'QA Coordinator', 'Admin'];
        $excludedUserIds = User::whereIn('role_id', function ($query) use ($excludedRoles) {
            $query->select('id')
                ->from('role_entry')
                ->whereIn('role', $excludedRoles);
        })->pluck('id');

        // Create ideas for users who are not excluded
        $eventIdeas = Idea::factory()->count(5)->make([
            'event_id' => $event->id,
            'user_id' => function () use ($excludedUserIds) {
                return User::whereNotIn('id', $excludedUserIds)->inRandomOrder()->first()->id;
            }
        ]);
        $event2Ideas = Idea::factory()->count(5)->make([
            'event_id' => $event2->id,
            'user_id' => function () use ($excludedUserIds) {
                return User::whereNotIn('id', $excludedUserIds)->inRandomOrder()->first()->id;
            }
        ]);

        // Save the created ideas
        $event->ideas()->saveMany($eventIdeas);
        $event2->ideas()->saveMany($event2Ideas);

        Comment::factory(20)->create();
    }
}
