<?php

namespace App\Database\Eloquent;

use App\Models\Dimension;
use Illuminate\Support\Facades\Validator;

trait ValidatesAttributes
{
    /**
     * @param  array|Illuminate\Database\Eloquent\Model  $input
     */
    public static function validate($input): bool
    {
        if (gettype($input) === 'object' && get_class($input) === Dimension::class) {
            $validator = Validator::make($input->attributesToArray(), static::VALIDATION_RULES);
        } else {
            $validator = Validator::make($input, static::VALIDATION_RULES);
        }

        return $validator->passes();
    }
}
