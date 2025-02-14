<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $fillable = [
        'resource_id', 'user_id', 'start_time', 'end_time'
    ];
    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
