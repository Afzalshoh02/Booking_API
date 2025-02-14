<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;
    protected $table = 'resources';
    protected $fillable = [
        'name', 'type', 'description'
    ];
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
