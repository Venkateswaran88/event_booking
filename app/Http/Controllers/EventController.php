<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Booking;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return all the events
        return Event::all();
    }

    /**
     * Display the specified resource with available dates
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEventWithAvailabeDates($id)
    {
        $event = Event::find($id);
        if ($event) {
            $event->available_dates = $event->availableDates();
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 400);
        }
        
        return $event;
    }

    /**
     * Return avaible slots for particular date and event
     *
     * @param Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAvailableSlotByDateAndEventId(Request $request)
    {
        $eventId = $request->id;
        $date = $request->date;
        $today = Carbon::today();

        if (Carbon::parse($date)->isBefore($today)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid date / past date'
            ], 400);
        }

        $event = Event::find($eventId);
        if ($event) {
            $event->available_slots = $event->getAvailableSlots($date);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 400);
        }

        return $event;
    }

    /**
     * Return all events with schedule and booking details
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllEvents()
    {
        $allevents = Event::all();
        foreach ($allevents as $event) {
            $maxOpeningPerSlot = $event->seat_per_slot;
            $eventId = $event->id;
            $availableDates = $event->availableDates();
            $eventSchedule = [];

            foreach ($availableDates as $availableDate) {
                $timeSlots = $event->getAvailableSlots($availableDate, true);

                if (!empty($timeSlots)) {
                    foreach ($timeSlots as $statTime => $timeSlot) {
                        $bookedCount = Booking::getBookedCount($eventId, $availableDate, $statTime);
                        $eventSchedule[$availableDate][$statTime]['slot'] = $timeSlot;
                        $eventSchedule[$availableDate][$statTime]['quantity_left'] = $maxOpeningPerSlot - $bookedCount;
                    }
                } else {
                    $eventSchedule[$availableDate] = [];
                }
            }
            $event->available_dates = $eventSchedule;
        }

        return $allevents;
    }
}
