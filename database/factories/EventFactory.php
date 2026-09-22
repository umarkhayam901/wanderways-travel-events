<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $destinations = [
            'Hunza Valley, Gilgit-Baltistan',
            'Skardu Deosai Plains, Gilgit',
            'Walled City, Lahore',
            'Hingol National Park & Kund Malir, Balochistan',
            'Fairy Meadows & Nanga Parbat Base, Diamer',
            'Swat Valley & Malam Jabba, KPK',
            'Cholistan Desert & Derawar Fort, Bahawalpur',
            'Neelum Valley, Azad Kashmir',
            'Nathia Gali & Mushkpuri Top, Abbottabad',
            'Ormara Beach & Makran Coastal Highway',
        ];

        return [
            'title' => fake()->randomElement([
                'Autumn Foliage & Apricot Blossom Expedition',
                'Deosai Wilderness & Stargazing Camp',
                'Mughal Architecture & Heritage Food Walk',
                'Princess of Hope Coastal Photography Roadtrip',
                'Alpine Ridge & Glacial Lakes Trek',
                'Green Valleys & Pine Forest Hiking Retreat',
                'Desert Jeep Rally & Dunes Starlight Night',
                'Crystal Streams & Waterfall Nature Trail',
                'Cloud Valley Ridge Walk & Birdwatching Safari',
                'Bioluminescent Bay & Coral Coast Expedition',
            ]),
            'description' => fake()->paragraph(3),
            'location' => fake()->randomElement($destinations),
            'event_date' => fake()->dateTimeBetween('+1 week', '+6 months')->format('Y-m-d'),
            'event_time' => fake()->randomElement(['06:30:00', '08:00:00', '09:30:00', '14:00:00', '17:30:00']),
        ];
    }
}
