<?php

namespace App\Actions\Appointments;

use Spatie\DataTransferObject\DataTransferObject;

class AppointmentData extends DataTransferObject
{
    public int $id;

    public int $place;

    public string $comment;
}
