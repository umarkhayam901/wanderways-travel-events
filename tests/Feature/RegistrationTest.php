<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    private Event $testEvent;

    protected function setUp(): void
    {
        parent::setUp();

        $this->testEvent = Event::create([
            'title' => 'Hunza Autumn Golden Valley Tour',
            'description' => 'A guided cultural tour through the ancient apricot orchards of Karimabad.',
            'location' => 'Karimabad, Hunza Valley',
            'event_date' => '2026-10-15',
            'event_time' => '07:30:00',
        ]);
    }

    /**
     * Test registration form page loads successfully.
     */
    public function test_registration_page_loads_successfully(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Join an Upcoming Travel Event');
        $response->assertSee('Select Travel Event');
        $response->assertSee('Full Name');
        $response->assertSee('Email Address');
    }

    /**
     * Test registration page displays selected event summary when event_id query param is present.
     */
    public function test_registration_page_displays_preselected_event(): void
    {
        $response = $this->get('/register?event_id=' . $this->testEvent->id);

        $response->assertStatus(200);
        $response->assertSee('Hunza Autumn Golden Valley Tour');
        $response->assertSee('Selected Adventure');
        $response->assertSee('Karimabad, Hunza Valley');
    }

    /**
     * Test a valid registration is successfully stored in the database.
     */
    public function test_valid_registration_is_stored_in_database(): void
    {
        $payload = [
            'event_id' => $this->testEvent->id,
            'name' => 'Umar Khayam',
            'email' => 'umar@example.com',
            'phone' => '+92 300 1234567',
        ];

        $response = $this->post('/register', $payload);

        $response->assertRedirect('/register?event_id=' . $this->testEvent->id);
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('registrations', [
            'event_id' => $this->testEvent->id,
            'name' => 'Umar Khayam',
            'email' => 'umar@example.com',
            'phone' => '+92 300 1234567',
        ]);

        // Check relationship
        $this->assertEquals(1, $this->testEvent->registrations()->count());
        $registration = Registration::first();
        $this->assertEquals($this->testEvent->id, $registration->event->id);
    }

    /**
     * Test missing required fields fail validation.
     */
    public function test_missing_required_fields_fail_validation(): void
    {
        $response = $this->post('/register', [
            'event_id' => '',
            'name' => '',
            'email' => '',
        ]);

        $response->assertSessionHasErrors(['event_id', 'name', 'email']);
        $this->assertDatabaseCount('registrations', 0);
    }

    /**
     * Test invalid email format fails validation.
     */
    public function test_invalid_email_format_fails_validation(): void
    {
        $response = $this->post('/register', [
            'event_id' => $this->testEvent->id,
            'name' => 'John Doe',
            'email' => 'not-a-valid-email',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertDatabaseCount('registrations', 0);
    }

    /**
     * Test non-existent event_id fails validation.
     */
    public function test_non_existent_event_id_fails_validation(): void
    {
        $response = $this->post('/register', [
            'event_id' => 99999,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $response->assertSessionHasErrors(['event_id']);
        $this->assertDatabaseCount('registrations', 0);
    }

    /**
     * Test duplicate registration with same email for the same event is rejected.
     */
    public function test_duplicate_registration_is_rejected(): void
    {
        // First registration
        Registration::create([
            'event_id' => $this->testEvent->id,
            'name' => 'First Registrant',
            'email' => 'duplicate@example.com',
            'phone' => '+92 300 1111111',
        ]);

        // Second registration attempt for the SAME event with SAME email
        $response = $this->post('/register', [
            'event_id' => $this->testEvent->id,
            'name' => 'Second Registrant',
            'email' => 'duplicate@example.com',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertDatabaseCount('registrations', 1);
    }

    /**
     * Test same email is allowed to register for a different travel event.
     */
    public function test_same_email_can_register_for_different_event(): void
    {
        $secondEvent = Event::create([
            'title' => 'Skardu Stargazing Expedition',
            'description' => 'Night camping in the Deosai plains.',
            'location' => 'Deosai, Skardu',
            'event_date' => '2026-10-22',
            'event_time' => '08:00:00',
        ]);

        Registration::create([
            'event_id' => $this->testEvent->id,
            'name' => 'Traveler Name',
            'email' => 'traveler@example.com',
        ]);

        $response = $this->post('/register', [
            'event_id' => $secondEvent->id,
            'name' => 'Traveler Name',
            'email' => 'traveler@example.com',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseCount('registrations', 2);
    }
}
