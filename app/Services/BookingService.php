<?php

namespace App\Services;

use App\Events\BookingCanceled;
use App\Events\BookingCreated;
use App\Exceptions\BookingNotFoundException;
use App\Repositories\BookingRepository;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class BookingService {
    protected $repository;
    public function __construct(BookingRepository $repository)
    {
        $this->repository = $repository;
    }
    public function create(array $data)
    {
        $booking = $this->repository->create($data);
        event(new BookingCreated($booking));
        return $booking;
    }
    public function cancel($id): void
    {
        $booking = $this->repository->find($id);
        if (!$booking) throw new BookingNotFoundException('Booking not found.');
        $this->repository->delete($id);
        event(new BookingCanceled($booking));
    }
}
