<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'resource_id' => \App\Models\Resource::inRandomOrder()->first()->id ?? 1,
            'user_id' => \App\Models\User::inRandomOrder()->first()->id ?? 1,
            'start_time' => now()->addDays(rand(1, 30)),
            'end_time' => now()->addDays(rand(31, 60)),
        ];
    }
}
