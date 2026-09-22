<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display a paginated listing of upcoming travel events.
     */
    public function index(): View
    {
        $events = Event::orderBy('event_date', 'asc')
            ->orderBy('event_time', 'asc')
            ->paginate(6);

        return view('events.index', compact('events'));
    }
}
