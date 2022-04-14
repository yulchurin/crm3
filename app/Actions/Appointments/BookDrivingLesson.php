<?php declare(strict_types=1);

namespace App\Actions\Appointments;

use App\Models\Appointment;
use App\Models\Place;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookDrivingLesson
{
    public function __invoke(AppointmentData $data, Appointment $appointment): void
    {
        //todo authorization
        $appointment->place()->associate(Place::find($data->place));
        $appointment->student()->associate(User::find(Auth::id()));
        $appointment->comment = $data->comment;

        $appointment->save();
        Log::channel('user_actions')->info(Auth::id() . ': ' .json_encode($data));
    }
}
