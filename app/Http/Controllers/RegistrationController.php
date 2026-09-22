<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    /**
     * Show the visitor-facing event registration form.
     */
    public function create(Request $request): View
    {
        $selectedEventId = $request->query('event_id');
        $selectedEvent = null;

        if ($selectedEventId) {
            $selectedEvent = Event::find($selectedEventId);
        }

        // Retrieve all available upcoming events for the dropdown selector
        $events = Event::orderBy('event_date', 'asc')->get();

        return view('registrations.create', compact('events', 'selectedEvent'));
    }

    /**
     * Validate and store a new event registration.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Server-side validation
        $validated = $request->validate([
            'event_id' => ['required', 'integer', 'exists:events,id'],
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:25'],
        ], [
            'event_id.required' => 'Please select a travel event to register for.',
            'event_id.exists' => 'The selected travel event does not exist.',
            'name.required' => 'Your full name is required.',
            'name.max' => 'Your name may not exceed 100 characters.',
            'email.required' => 'A valid email address is required.',
            'email.email' => 'Please provide a valid email format (e.g. traveler@example.com).',
            'email.max' => 'Your email may not exceed 150 characters.',
            'phone.max' => 'Your phone number may not exceed 25 characters.',
        ]);

        // 2. Duplicate registration check (same email for the same event)
        $alreadyRegistered = Registration::where('event_id', $validated['event_id'])
            ->where('email', $validated['email'])
            ->exists();

        if ($alreadyRegistered) {
            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'This email address is already registered for this travel event.',
                ]);
        }

        // 3. Database storage
        Registration::create($validated);

        $event = Event::findOrFail($validated['event_id']);

        // 4. Redirect with confirmation success message
        return redirect()
            ->route('registrations.create', ['event_id' => $event->id])
            ->with('success', 'Registration confirmed! You have successfully registered for "' . $event->title . '". We look forward to your journey with WanderWays!');
    }
}
