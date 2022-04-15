<?php

namespace App\Http\Resources;

use App\Models\Student;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'active' => $this->active === true,
            'person' => $this?->person,
            'paper' => $this?->paper,
            'parent' => $this?->legalRepresentativePerson,
            'permissions' => $this->permissions,
            'isMinor' => Student::find($this->id)->isMinor(),
        ];
    }
}
