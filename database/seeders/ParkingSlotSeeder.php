<?php

namespace Database\Seeders;

use App\Models\ParkingSlot;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ParkingSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ParkingSlot::create(['slot_id' => 'A1', 'status' => 0]); // Slot kosong
        ParkingSlot::create(['slot_id' => 'A2', 'status' => 0]); // Slot kosong
    }
}
