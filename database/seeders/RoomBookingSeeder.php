<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoomBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\RoomBooking::truncate();
        \App\Models\RoomBooking::create([
            'room_id' => 1,
            'user_id' => 3,
            'created_by' => 1,
            'title' => "Meeting Direksi",
            'start_date' => "2021-09-14 09:00:00",
            'end_date' => "2021-09-14 10:00:00",
            'start_hour' => '09:00',
            'end_hour' => '10:00',
        ]);
    }
}
