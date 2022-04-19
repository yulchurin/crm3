<?php

namespace App\Actions\Appointments;

use App\Models\Place;
use App\Models\User;
use Spatie\DataTransferObject\DataTransferObject;

class AppointmentData extends DataTransferObject
{
    public Place $place;

    public string $comment;
}
