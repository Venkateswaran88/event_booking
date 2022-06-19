<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Return booked count
     *
     */
    public static function getBookedCount($eventId, $date, $slotStartTime)
    {
        return Booking::where('event_id', $eventId)
            ->where('booking_date', $date)
            ->where('start_time', $slotStartTime)->count();
    }
}
