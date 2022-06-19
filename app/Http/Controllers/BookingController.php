<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Booking;
use Carbon\Carbon;
use Exception;

class BookingController extends Controller
{
    /**
     * Book a slot
     *
     * @param Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bookSlot(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'event_id' => 'required|integer',
            'date' => 'required|date_format:Y-m-d|after:yesterday',
            'start_time' => 'required|integer',
            'email' => 'required|email',
            'first_name' => 'required|string',
            'last_name' => 'nullable|string'
         ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->messages()
            ], 400);
        }

        $eventId = $request->event_id;
        $date = $request->date;
        $slotStartTime = $request->start_time;

        $event = Event::with(['holidays'])->find($eventId);
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 400);
        }
        $futureDays = $event->no_of_days_before_book;
        $maxOpeningPerSlot = $event->seat_per_slot;

        $checkDateIsNotHoliday = $event->holidays()->where('holidays.date', $date)->get()->pluck('date')->toArray();

        // check requested date is greater than the future days setting / past date / holiday
        if (Carbon::parse($date) > Carbon::today()->addDays($futureDays)
            || Carbon::parse($date) < Carbon::today()
            || count($checkDateIsNotHoliday)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid date / Holiday'
                ], 400);
        }

        // Make sure selected start time (slot) is available
        $isSlotAvailable = $event->checkValidSlot($date, $slotStartTime);
        if (!$isSlotAvailable) {
            return response()->json([
                'success' => false,
                'message' => 'Time slot is not available'
            ], 400);
        }

        // check already booked count for particular event, slot and date
        $bookedCount = Booking::getBookedCount($eventId, $date, $slotStartTime);

        if ($bookedCount >= $maxOpeningPerSlot) {
            return response()->json([
                'success' => false,
                'message' => 'Time slot is full. Please select another one'
            ], 400);
        } else {
            try {
                $booking = Booking::create([
                    'event_id' => $eventId,
                    'booking_date' => $date,
                    'start_time' => $slotStartTime,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                ]);
                
                if ($booking) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Slot booked successfully'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Already booked / failed to book'
                    ], 400);
                }
            } catch (Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Already booked / failed to book'
                ], 400);
            }
        }
    }
}
