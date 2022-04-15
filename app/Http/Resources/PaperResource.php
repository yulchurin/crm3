<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PaperResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'series' => $this->series,
            'number' => $this->number,
            'issuer' => $this->issuer,
            'issuance_date' => $this->issuance_date?->format('Y-m-d'),
            'place_of_birth' => $this->place_of_birth,
            'snils' => $this->snils,
        ];
    }
}
