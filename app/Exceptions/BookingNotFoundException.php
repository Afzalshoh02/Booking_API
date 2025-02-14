<?php

namespace App\Exceptions;

use Exception;

class BookingNotFoundException extends Exception
{
    public function __construct($message = "Booking not found.", $code = 404)
    {
        parent::__construct($message, $code);
    }
}
