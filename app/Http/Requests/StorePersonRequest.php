<?php

namespace App\Http\Requests;

use App\Models\Person;
use App\Rules\SnilsValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StorePersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Person::class) || $this->user()->can('update', $this->user()->person);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'gender',
            'last_name',
            'first_name',
            'middle_name',
            'date_of_birth',
            'phone',
            'address_zip',
            'address_region',
            'address_city',
            'address_street',
            'address_house',
            'address_flat',
            'passport_series',
            'passport_number',
            'passport_issuer',
            'passport_issuance_date',
            'place_of_birth',
            'snils' => [
                'required',
                'digits:11',
                Rule::unique('people')->ignore(Auth::user()->person->id, 'id'),
                Rule::unique('people')->ignore(Auth::user()->parent->id, 'id'),
                new SnilsValidation(),
            ],
        ];
    }
}
