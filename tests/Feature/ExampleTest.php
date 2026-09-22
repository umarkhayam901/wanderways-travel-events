<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the WanderWays Travel homepage loads with semantic HTML and required content.
     */
    public function test_homepage_returns_successful_response_with_semantic_elements(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('<header', false);
        $response->assertSee('<nav', false);
        $response->assertSee('<main', false);
        $response->assertSee('<footer', false);
        $response->assertSee('WanderWays Travel', false);
        $response->assertSee('Discover Unique', false);
        $response->assertSee('css/wanderways.css', false);
        $response->assertSee(route('events.index'), false);
    }

    /**
     * Test the WanderWays Events page loads with status 200.
     */
    public function test_events_route_returns_successful_response(): void
    {
        $response = $this->get('/events');

        $response->assertStatus(200);
        $response->assertSee('Upcoming Travel Events', false);
        $response->assertSee('<header', false);
        $response->assertSee('<footer', false);
    }
}
