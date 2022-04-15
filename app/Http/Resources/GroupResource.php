<?php

namespace App\Http\Resources;

use App\Transformers\MoneyTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'start' => $this->start?->format('d.m.Y'),
            'end' => $this->end?->format('d.m.Y'),
            'base_price' => MoneyTransformer::getStringWithSymbol($this->base_price),
            'drive_hours' => $this->drive_hours,
            'price_per_driving_hour' => MoneyTransformer::getStringWithSymbol($this->price_per_driving_hour),
        ];
    }
}
