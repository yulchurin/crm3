<?php

namespace App\Rules;

use App\Utilities\SnilsValidator;
use Illuminate\Contracts\Validation\Rule;

class SnilsValidation implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return SnilsValidator::validate($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'СНИЛС некорректный!';
    }
}
