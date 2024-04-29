<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class filter implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
    /*     if (strtoupper($value) !== $value) {
            $fail('The :attribute must be uppercase.');
        }    */
        if (in_array(strtolower($value) , ['admin','php'])) {
            $fail('The :attribute cant be this value.');
        }   
     }
}
