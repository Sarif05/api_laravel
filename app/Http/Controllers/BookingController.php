<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingCreateRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Notifications\BookingNotification;
use Illuminate\Support\Facades\Notification;

class BookingController extends Controller
{
    public function store(BookingCreateRequest $request): BookingResource
    {
        // Validasi data pemesanan hotel
        $data = $request->validated();
        $booking = new Booking($data);
        $booking->save();

        Notification::send("sarif@yopmail.com", new BookingNotification($booking));

        return new BookingResource($booking);
    }
}