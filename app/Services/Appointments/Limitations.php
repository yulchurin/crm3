<?php

namespace App\Services\Appointments;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

/**
 * If the limit is reached, the method will return true
 */
class Limitations
{
    /**
     * Determines whether the Student has used up the weekly booking limit
     *
     * @return bool
     */
    public static function weekly(): bool
    {
        $student = Auth::user();

        $limitPerWeek = $student?->limit?->per_week ?? $student->group?->limit?->per_week;

        return Appointment::ofThisStudent()
                ->ofThisWeekAndHigher()
                ->count() >= $limitPerWeek;
    }

    /**
     * Determines whether the Student has used up the daily booking limit
     *
     * @return bool
     */
    public static function daily(): bool
    {
        $student = Auth::user();

        $limitPerDay = $student?->limit?->per_day ?? $student->group?->limit?->per_day;

        return Appointment::ofThisStudent()
                ->ofToday()
                ->count() >= $limitPerDay;
    }

    /**
     * Determines whether the Student has paid the amount sufficient to book the lessons
     *
     * @return bool
     */
    public static function payment(): bool
    {
        return false;
    }

    /**
     * Determines whether the allotted time has been spent
     *
     * @return bool
     */
    public static function allottedTime(): bool
    {
        $appointments = Appointment::ofThisStudent()->with('schedule')->get();
        $student = Auth::user();
        $group = $student->group;

        $totalSpentSeconds = $appointments->sum(function ($appointment) {
            return $appointment->schedule?->duration;
        });

        // divide by 3600 = hours (60 minutes in one hour, 60 seconds in one minute - 60*60)
        return ($totalSpentSeconds / 3600) >= $group?->getDriveHours();
    }

    /**
     * Checks all limitations in this class
     *
     * @return bool
     */
    public static function all(): bool
    {
        return
            self::weekly() ||
            self::allottedTime() ||
            self::daily() ||
            self::payment();
    }
}
