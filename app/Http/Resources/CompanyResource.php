<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'name' => $this->name,
            'short_name' => $this->short_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => [
                'zip' => $this->zip,
                'region' => $this->region,
                'city' => $this->city,
                'street' => $this->street,
                'house' => $this->house,
                'office' => $this->office,
            ],
            'OGRN' => $this->OGRN,
            'INN' => $this->INN,
            'KPP' => $this->KPP,
            'bank' => [
                'bic' => $this->bank_BIC,
                'name' => $this->bank_name,
                'account' => $this->bank_account,
                'nostro' => $this->bank_corr_account,
            ],
            'manager' => [
                'post' => $this->manager_post,
                'first_name' => $this->manager_first_name,
                'last_name' => $this->manager_last_name,
                'middle_name' => $this->manager_middle_name,
            ],
            'license' => [
                'issuer' => $this->license_issuer,
                'number' => $this->license_number,
                'blank_series' => $this->license_blank_series,
                'blank_number' => $this->license_blank_number,
                'issuance_date' => $this->license_issuance_date,
            ],
        ];
    }
}
