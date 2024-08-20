<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookingSeeder extends Seeder
{
    public function run()
    {
        // Проверете дали датотеката постои
        if (!Storage::disk('local')->exists('bookings.json')) {
            $this->command->error('The file bookings.json does not exist.');
            return;
        }

        $jsonData = Storage::disk('local')->get('bookings.json');
        $data = json_decode($jsonData, true);

        // Проверете дали JSON е правилно декодиран
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->command->error('Error decoding JSON data: ' . json_last_error_msg());
            return;
        }

        foreach ($data as $entry) {
            // Проверете дали сите потребни полиња се присутни
            if (!isset($entry['id'], $entry['employee_name'], $entry['event_name'], $entry['event_date'], $entry['price'])) {
                $this->command->error('Missing required fields in JSON data.');
                continue;
            }

            DB::table('bookings')->updateOrInsert(
                ['id' => $entry['id']],
                [
                    'employee_name' => $entry['employee_name'],
                    'event_name' => $entry['event_name'],
                    'event_date' => $entry['event_date'],
                    'price' => $entry['price']
                ]
            );
        }
    }
}