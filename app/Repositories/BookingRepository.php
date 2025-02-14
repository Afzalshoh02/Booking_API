<?php

namespace App\Repositories;

use App\Models\Booking;

class BookingRepository {
    public function getByResourceId($id)
    {
        return Booking::where('resource_id', $id)->get();
    }
    public function create(array $data)
    {
        return Booking::create($data);
    }
    public function find($id)
    {
        return Booking::find($id);
    }
    public function delete($id)
    {
        Booking::destroy($id);
    }
}
