<?php

namespace App\Actions\Appointments;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CancelBookedDrivingLesson
{
    /**
     * Disassociates the student from the passed appointment
     *
     * @param Appointment $appointment
     * @return void
     */
    public function __invoke(Appointment $appointment)
    {
        $appointment->student()->dissociate();
        $appointment->comment = null;
        $appointment->save();

        Log::channel('user_actions')->info(Auth::id() . ': cancelled ' . $appointment->id);
    }
}
