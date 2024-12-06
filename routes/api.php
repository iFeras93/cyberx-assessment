<?php

use App\Http\Controllers\UserAnalyticsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//users analytics route
Route::get('/user-analytics', UserAnalyticsController::class)->name('user-analytics');
