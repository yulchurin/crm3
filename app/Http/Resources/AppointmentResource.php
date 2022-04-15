<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $weekMap = ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'];
        return [
            'id' => $this->id,
            'instructor' => [
                'name' => $this->instructor?->name,
                'link' => $this->instructor?->phone,
                'phone' => '(' .
                    Str::substr($this->instructor?->phone, 0, 3) .') '.
                    Str::substr($this->instructor?->phone, 3, 3) .'-'.
                    Str::substr($this->instructor?->phone, 6, 2) .'-'.
                    Str::substr($this->instructor?->phone, 8, 2),
            ],
            'student' => $this->student ? [
                'name' => $this->student?->name,
                'link' => $this->student?->person?->phone,
                'phone' => '(' .
                    Str::substr($this->student?->person?->phone, 0, 3) .') '.
                    Str::substr($this->student?->person?->phone, 3, 3) .'-'.
                    Str::substr($this->student?->person?->phone, 6, 2) .'-'.
                    Str::substr($this->student?->person?->phone, 8, 2),
            ] : null,
            'date' => $this->date?->format('d.m.Y'),
            'start' => $this->schedule?->start?->format('H:i'),
            'dayOfWeek' => $weekMap[$this->date?->dayOfWeek],
            'end' => $this->schedule?->start?->addMinutes($this->schedule?->duration)?->format('H:i'),
            'car' => [
                'model' => $this->vehicle?->model,
                'number' => Str::substr($this->vehicle?->number, 0, 1) .' '.
                            Str::substr($this->vehicle?->number, 1, 3) .' '.
                            Str::substr($this->vehicle?->number, 4, 2) .' | '.
                            Str::substr($this->vehicle?->number, 6, 3),
                'color' => $this->vehicle?->color,
            ],
            'place' => [
                'name' => $this->place?->name,
                'location' => $this->place?->location,
                'address' => $this->place?->address,
            ],
            'bookedByMe' => $this->student_id === $request->user()->id,
            'comment' => $this->comment,
        ];
    }
}
