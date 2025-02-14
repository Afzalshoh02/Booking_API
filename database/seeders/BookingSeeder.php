<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resources = Resource::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();

        for ($i = 0; $i < 15; $i++) {
            Booking::create([
                'resource_id' => $resources[array_rand($resources)],
                'user_id' => $users[array_rand($users)],
                'start_time' => now()->addDays(rand(1, 30))->format('Y-m-d H:i:s'),
                'end_time' => now()->addDays(rand(31, 60))->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
