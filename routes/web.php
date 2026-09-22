<?php

use Illuminate\Support\Facades\Route;

/**
 * WanderWays Travel Event Management Mini-Platform
 * Web Routes
 */

// Task 1: Public Homepage
Route::get('/', function () {
    return view('home');
})->name('home');

// Task 1: Events Navigation Placeholder Route (expanded in Task 2)
Route::get('/events', function () {
    return view('events.index');
})->name('events.index');
