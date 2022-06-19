<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    public function holidays()
    {
        return $this->belongsToMany('App\Models\Holiday', 'event_holidays', 'event_id', 'holiday_id');
    }

    public function intervals()
    {
        return $this->belongsToMany('App\Models\Interval', 'event_intervals', 'event_id', 'interval_id');
    }

    public function timeSlots()
    {
        return $this->belongsToMany('App\Models\TimeSlot', 'event_time_slots', 'event_id', 'time_slot_id');
    }

    /**
     * Return available dates in event object
     *
     */
    public function availableDates()
    {
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays($this->no_of_days_to_list);
        $dates = [];

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        $holidayList = $this->holidays()->get()->pluck('date')->toArray();
        // remove holiday dates
        $avaibaleDates = array_values(array_diff($dates, $holidayList));
        return $avaibaleDates;
    }

    /**
     * Return avaible slots in event object for particular date
     *
     */
    public function getAvailableSlots($date, $allSlots = false)
    {
        $dayOfWeek = date('w', strtotime($date));
        $timeSlots = [];

        $checkDateIsNotHoliday = $this->holidays()->where('holidays.date', $date)->get()->pluck('date')->toArray();
        if (count($checkDateIsNotHoliday)) {
            return [];
        }

        $timeSlotDetail = $this->timeSlots()->where('event_time_slots.day_of_week', $dayOfWeek)->first();
        $eventIntervalDetail = $this->intervals()->get();

        if ($timeSlotDetail) {
            $startTime = $timeSlotDetail->start_time;
            $endTime = $timeSlotDetail->end_time;
            $currentTimeInseconds = date('H') * 3600 + date('i') * 60 + date('s');
            for ($i = $startTime; $i < $endTime; $i += ($this->duration + $this->break_duration)) {
                $slotEndTime = $i+$this->duration;
                // skip slot if endtime is less than current time (for today)
                if ($slotEndTime < $currentTimeInseconds && !$allSlots && $date == date('Y-m-d')) {
                    continue;
                }
                // remove if the slot is conflict between the break time
                foreach ($eventIntervalDetail as $interval) {
                    $intervalStartTime = $interval->start_time;
                    $intervalEndTime = $interval->end_time;
                    if (($i > $intervalStartTime && $i < $intervalEndTime)
                        || ($slotEndTime > $intervalStartTime && $slotEndTime < $intervalEndTime)) {
                        continue 2;
                    }
                }
                $timeSlots[$i] = date('h:i A', mktime(0, 0, $i)). ' - ' .  date('h:i A', mktime(0, 0, $slotEndTime));
            }
        }
        return $timeSlots;
    }

    /**
     * Check given slot is valid
     *
     */
    public function checkValidSlot($date, $slotStartTime)
    {
        $availableSlots = $this->getAvailableSlots($date);
        return array_key_exists($slotStartTime, $availableSlots);
    }
}
