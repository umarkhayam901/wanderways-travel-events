<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Hunza Autumn Golden Valley Tour',
                'description' => 'Experience the world-renowned autumn foliage of Hunza Valley. Journey through ancient apricot orchards, visit the 900-year-old Altit and Baltit forts, and watch the sun set behind the majestic Rakaposhi peak with seasoned local guides.',
                'location' => 'Karimabad, Hunza Valley',
                'event_date' => '2026-10-15',
                'event_time' => '07:30:00',
            ],
            [
                'title' => 'Skardu & Deosai Stargazing Expedition',
                'description' => 'A high-altitude camping adventure across the legendary Deosai Plains, known as the Land of Giants. Includes guided astrophotography sessions, visits to crystal-clear Sheosar Lake, and traditional Balti storytelling by campfire.',
                'location' => 'Deosai National Park, Skardu',
                'event_date' => '2026-10-22',
                'event_time' => '08:00:00',
            ],
            [
                'title' => 'Lahore Walled City Heritage & Food Walk',
                'description' => 'Wander through 13 historic gates, the grand Badshahi Mosque, Delhi Gate, and the restored Shahi Hammam. Conclude the cultural evening with authentic local cuisine along historic food streets accompanied by historians.',
                'location' => 'Delhi Gate, Walled City, Lahore',
                'event_date' => '2026-10-29',
                'event_time' => '16:00:00',
            ],
            [
                'title' => 'Hingol Coastal & Mud Volcanoes Exploration',
                'description' => 'Drive along the dramatic Makran Coastal Highway. Marvel at the natural rock formations of the Sphinx and Princess of Hope, explore active mud volcanoes of Chandragup, and unwind at the secluded beaches of Kund Malir.',
                'location' => 'Hingol National Park, Makran Coast',
                'event_date' => '2026-11-05',
                'event_time' => '06:00:00',
            ],
            [
                'title' => 'Fairy Meadows & Nanga Parbat Base Trek',
                'description' => 'A breathtaking alpine expedition crossing the Raikot Bridge and jeep track to Fairy Meadows. Hike up to the foot of the mighty Killer Mountain (Nanga Parbat, 8,126m) with certified mountain rescue guides and porters.',
                'location' => 'Raikot, Diamer District',
                'event_date' => '2026-11-12',
                'event_time' => '06:30:00',
            ],
            [
                'title' => 'Swat Valley & Malam Jabba Eco Hiking Retreat',
                'description' => 'Discover the lush valleys of the "Switzerland of the East". Traverse tranquil pine forests, discover ancient Buddhist archaeological sites at Butkara, and enjoy sweeping panoramic views from the Malam Jabba ridge trail.',
                'location' => 'Malam Jabba, Swat Valley',
                'event_date' => '2026-11-19',
                'event_time' => '09:00:00',
            ],
            [
                'title' => 'Cholistan Desert Camel Safari & Derawar Camp',
                'description' => 'An unforgettable desert odyssey into the vast Thar-Cholistan sands. Camp under pristine starry skies in front of the colossal 40-bastion Derawar Fort, accompanied by desert folk musicians and camel caravans.',
                'location' => 'Derawar Fort, Cholistan Desert',
                'event_date' => '2026-11-26',
                'event_time' => '15:30:00',
            ],
            [
                'title' => 'Neelum Valley Alpine Streams & Waterfall Trail',
                'description' => 'Trek alongside azure glacial streams, wooden suspension bridges, and lush cedar slopes in the heart of Kashmir. Highlights include Dhani Waterfall, Kutton, and the peaceful border town of Keran overlooking the river.',
                'location' => 'Keran & Sharda, Neelum Valley',
                'event_date' => '2026-12-03',
                'event_time' => '08:30:00',
            ],
            [
                'title' => 'Mushkpuri Top Winter Pine Forest Hike',
                'description' => 'A crisp morning trek through the Galiyat mountain reserve leading to the scenic Mushkpuri Summit (2,800m). Enjoy 360-degree vistas of the snow-clad Pir Panjal range and Ayubia National Park.',
                'location' => 'Nathia Gali, Abbottabad',
                'event_date' => '2026-12-10',
                'event_time' => '08:00:00',
            ],
            [
                'title' => 'Ormara Turtle Beach Marine Conservation Tour',
                'description' => 'A weekend coastal trip focused on marine wildlife and eco-tourism. Witness green sea turtle nesting sanctuaries, kayak along hammerhead cliffs, and enjoy fresh coastal barbecue by the Arabian Sea.',
                'location' => 'Ormara Coastal Belt, Balochistan',
                'event_date' => '2026-12-17',
                'event_time' => '07:00:00',
            ],
            [
                'title' => 'Peshawar Old Bazaar & Khyber Storytelling Walk',
                'description' => 'Explore the legendary Qissa Khwani (Bazaar of Storytellers), the historic Mahabat Khan Mosque, and Sethi House. Experience traditional copper craftsmanship, green tea culture, and rich silk route history.',
                'location' => 'Qissa Khwani Bazaar, Peshawar',
                'event_date' => '2026-12-24',
                'event_time' => '10:00:00',
            ],
            [
                'title' => 'Chitral & Kalash Valley Cultural Festival',
                'description' => 'Join the indigenous Kalasha community in the valleys of Bumburet and Rumbur. Witness traditional rhythmic dances, vibrant handwoven dresses, and sacred folk customs nestled beneath the shadow of Tirich Mir.',
                'location' => 'Bumburet Valley, Chitral',
                'event_date' => '2027-01-07',
                'event_time' => '09:30:00',
            ],
            [
                'title' => 'Soon Valley & Salt Range Nature Photowalk',
                'description' => 'Explore the geological marvels of the Salt Range and Uchhali Lake wetlands. A birdwatcher and landscape photographer dream filled with migrating flamingo flocks and pink salt mines.',
                'location' => 'Uchhali Complex, Soon Valley',
                'event_date' => '2027-01-14',
                'event_time' => '07:30:00',
            ],
            [
                'title' => 'Margalla Ridge Trail & Monal Sunset Gathering',
                'description' => 'A scenic day hike connecting Trail 3 and Trail 5 across the Margalla Hills National Park. Conclude with panoramic sunset views over the capital city and a warm networking dinner with fellow travelers.',
                'location' => 'Trail 3, Margalla Hills, Islamabad',
                'event_date' => '2027-01-21',
                'event_time' => '14:30:00',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
