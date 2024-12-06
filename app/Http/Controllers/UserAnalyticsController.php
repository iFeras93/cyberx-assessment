<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserAnalyticsController extends Controller
{
    /**
     * Get users analytics.
     ** */
    public function __invoke(Request $request): JsonResponse
    {
        $users = User::with('tasks')->get()->map(function ($user) {
            $tasks = $user->tasks;
            return [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'avg_score' => $tasks->avg('score'),
                'avg_progress' => $tasks->avg('progress'),
                'assessment_count' => $tasks->where('task_type', 'assessment')->count(),
                'survey_count' => $tasks->where('task_type', 'survey')->count(),
            ];
        });
        return response()->json($users);
    }
}
