<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('get users analytics correctly', function () {

    //create users
    $users = User::factory()->count(2)->create();

    //create tasks for each user
    $users->each(function ($user) {
        Task::factory()->count(5)->create([
            'user_id' => $user->id,
            'task_type' => 'assessment',
            'score' => 80,
            'progress' => 60,
        ]);

        Task::factory()->count(3)->create([
            'user_id' => $user->id,
            'task_type' => 'survey',
            'score' => 90,
            'progress' => 80,
        ]);
    });

    // Call the API endpoint
    $response = $this->getJson('/api/user-analytics');

    // Assert response structure
    $response->assertStatus(200);
    $response->assertJsonCount(2); // Two users

    $response->assertJson([
        [
            'user_id' => $users[0]->id,
            'user_name' => $users[0]->name,
            'avg_score' => 83.75,
            'avg_progress' => 67.5,
            'assessment_count' => 5,
            'survey_count' => 3,
        ],
        [
            'user_id' => $users[1]->id,
            'user_name' => $users[1]->name,
            'avg_score' => 83.75,
            'avg_progress' => 67.5,
            'assessment_count' => 5,
            'survey_count' => 3,
        ],
    ]);

});
