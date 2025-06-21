<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'name' => 'Tech Expo 2025',
                'location' => 'Malta',
                'date' => '2025-09-10',
                'description' => 'Annual technology expo in Malta.',
            ],
            [
                'name' => 'Fintech Summit',
                'location' => 'Brazil',
                'date' => '2025-10-05',
                'description' => 'Financial innovation conference.',
            ],
            [
                'name' => 'Startup Week Eurasia',
                'location' => 'Eurasia',
                'date' => '2025-11-15',
                'description' => 'Regional startup event.',
            ],
        ];

        foreach ($events as $data) {
            Event::updateOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}

