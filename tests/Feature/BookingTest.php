<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class BookingTest extends TestCase
{
    /**
     * A basic feature test example.
     */
//    public function test_example(): void
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }

    public function test_can_get_resources_list() //Тест для получения списка ресурсов
    {
        $resources = Resource::factory()->count(3)->create();
        $response = $this->getJson('/api/resources');
        $response->assertStatus(200);
        foreach ($resources as $resource) {
            $response->assertJsonFragment([
                'id' => $resource->id,
                'name' => $resource->name,
                'type' => $resource->type,
                'description' => $resource->description,
            ]);
        }
    }

    public function test_can_create_resource() //Тест для создания ресурса
    {
        $data = [
            'name' => 'Test Resource',
            'type' => 'Test Type',
            'description' => 'This is a test resource.',
        ];
        $response = $this->postJson('/api/resources', $data);
        $response->assertStatus(201);
        $response->assertJsonFragment([
            'name' => 'Test Resource',
            'type' => 'Test Type',
            'description' => 'This is a test resource.',
        ]);
        $this->assertDatabaseHas('resources', [
            'name' => 'Test Resource',
            'type' => 'Test Type',
            'description' => 'This is a test resource.',
        ]);
    }
    public function test_create_resource_with_required_fields_only() //Тест для создания ресурса с обязательными полями
    {
        $data = [
            'name' => 'Minimal Resource',
            'type' => 'Minimal Type',
        ];
        $response = $this->postJson('/api/resources', $data);
        $response->assertStatus(201);
        $response->assertJsonFragment([
            'name' => 'Minimal Resource',
            'type' => 'Minimal Type',
        ]);
        $this->assertDatabaseHas('resources', [
            'name' => 'Minimal Resource',
            'type' => 'Minimal Type',
        ]);
    }
    public function test_create_resource_with_missing_required_fields() //Тест для создания ресурса с отсутствующим обязательным полем
    {
        $data = [
            'type' => 'Invalid Resource Type',
        ];
        $response = $this->postJson('/api/resources', $data);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
    }

    public function test_can_get_bookings_for_resource() //Тест для получения всех бронирований для ресурса
    {
        $resource = Resource::factory()->create();
        $user = User::factory()->create();
        $booking1 = Booking::factory()->create([
            'resource_id' => $resource->id,
            'user_id' => $user->id,
            'start_time' => now()->addHour(),
            'end_time' => now()->addHours(2),
        ]);
        $booking2 = Booking::factory()->create([
            'resource_id' => $resource->id,
            'user_id' => $user->id,
            'start_time' => now()->addHours(3),
            'end_time' => now()->addHours(4),
        ]);
        $response = $this->getJson("/api/resources/{$resource->id}/bookings");
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'resource_id' => $resource->id,
            'user_id' => $user->id,
            'end_time' => $booking1->end_time->format('Y-m-d H:i:s'),
        ]);
        $response->assertJsonFragment([
            'resource_id' => $resource->id,
            'user_id' => $user->id,
            'end_time' => $booking2->end_time->format('Y-m-d H:i:s'),
        ]);
    }
    public function test_can_get_empty_bookings_for_resource() //Тест для получения бронирований для ресурса, у которого нет бронирований
    {
        $resource = Resource::factory()->create();
        $response = $this->getJson('/api/resources/' . $resource->id . '/bookings');
        $response->assertStatus(200);
        $response->assertJsonCount(0, 'data');
    }
    public function test_booking_creation() {
        $resource = Resource::factory()->create();
        $user = User::factory()->create();
        $response = $this->postJson('/api/bookings', [
            'resource_id' => $resource->id,
            'user_id' => $user->id,
            'start_time' => now()->addHour()->format('Y-m-d'),
            'end_time' => now()->addDays(1)->format('Y-m-d'),
        ]);
        $response->assertStatus(201);
    }
}
