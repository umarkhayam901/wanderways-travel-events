<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test /events returns HTTP 200 and loads successfully.
     */
    public function test_events_page_returns_http_200(): void
    {
        $response = $this->get('/events');

        $response->assertStatus(200);
        $response->assertSee('Upcoming Travel Events', false);
        $response->assertSee('<header', false);
        $response->assertSee('<footer', false);
    }

    /**
     * Test events stored in the database are displayed on the page.
     */
    public function test_events_page_displays_events_from_database(): void
    {
        $event = Event::create([
            'title' => 'Karakoram Highway Mountain Roadtrip',
            'description' => 'A dramatic high-altitude roadtrip along the eighth wonder of the world.',
            'location' => 'Passu Cones, Hunza',
            'event_date' => '2026-11-20',
            'event_time' => '08:00:00',
        ]);

        $response = $this->get('/events');

        $response->assertStatus(200);
        $response->assertSee('Karakoram Highway Mountain Roadtrip');
        $response->assertSee('Passu Cones, Hunza');
        $response->assertSee('Nov');
        $response->assertSee('20');
        $response->assertSee('2026');
        $response->assertSee('08:00 AM');
    }

    /**
     * Test pagination works when multiple events exist.
     */
    public function test_events_page_pagination_works(): void
    {
        // Create 8 events (6 per page)
        for ($i = 1; $i <= 8; $i++) {
            Event::create([
                'title' => sprintf('Expedition Number %02d', $i),
                'description' => 'A curated travel expedition for testing pagination controls.',
                'location' => 'Destination ' . $i,
                'event_date' => now()->addDays($i)->format('Y-m-d'),
                'event_time' => '09:00:00',
            ]);
        }

        // Page 1 should display first 6 events and link to page 2
        $responsePage1 = $this->get('/events');
        $responsePage1->assertStatus(200);
        $responsePage1->assertSee('Expedition Number 01');
        $responsePage1->assertSee('Expedition Number 06');
        $responsePage1->assertDontSee('Expedition Number 07');
        $responsePage1->assertSee('page=2');

        // Page 2 should display remaining 2 events
        $responsePage2 = $this->get('/events?page=2');
        $responsePage2->assertStatus(200);
        $responsePage2->assertSee('Expedition Number 07');
        $responsePage2->assertSee('Expedition Number 08');
        $responsePage2->assertDontSee('Expedition Number 01');
    }

    /**
     * Test empty state message displays when no events are scheduled.
     */
    public function test_events_page_shows_empty_state_when_no_events_exist(): void
    {
        $response = $this->get('/events');

        $response->assertStatus(200);
        $response->assertSee('No Upcoming Events Found');
        $response->assertSee('Back to Homepage');
    }
}
