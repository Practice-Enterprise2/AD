<?php

namespace App\Database\Eloquent;

use Illuminate\Support\Facades\Validator;

trait ValidatesAttributes
{
    /**
     * @param  array|Illuminate\Database\Eloquent\Model  $input
     */
    public static function validate($input): bool
    {
        if (gettype($input) === 'object') {
            $validator = Validator::make($input->attributesToArray(), static::VALIDATION_RULES);
        } else {
            $validator = Validator::make($input, static::VALIDATION_RULES);
        }

        return $validator->passes();
    }
}
