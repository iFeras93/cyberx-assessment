<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\Assessment;
use App\Models\Survey;
use App\Models\Task;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        User::factory(10)->create()->each(function ($user) {
            // Create assessments for each user
            Assessment::factory(5)->create(['user_id' => $user->id]);

            // Create surveys for each user
            Survey::factory(8)->create(['user_id' => $user->id]);

            // Create tasks for each user
            Task::factory(5)->create(['user_id' => $user->id]);

            // Create activity logs for each user
            ActivityLog::factory(7)->create(['user_id' => $user->id]);
        });

    }
}
