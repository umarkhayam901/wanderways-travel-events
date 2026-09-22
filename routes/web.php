<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

/**
 * WanderWays Travel Event Management Mini-Platform
 * Web Routes
 */

// Task 1: Public Homepage
Route::get('/', function () {
    return view('home');
})->name('home');

// Task 2: Database-driven Events Listing with Pagination
Route::get('/events', [EventController::class, 'index'])->name('events.index');
