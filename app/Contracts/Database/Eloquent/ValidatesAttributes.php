<?php

namespace App\Contracts\Database\Eloquent;

interface ValidatesAttributes
{
    /**
     * The validation rules used to check the validity of the model.
     */
    const VALIDATION_RULES = [];

    /**
     * Check the validity of the model using its `VALIDATION_RULES`.
     *
     * @param  array|Illuminate\Database\Eloquent\Model  $input Input attributes
     * @return bool Whether `$input` is valid or not
     */
    public static function validate($input): bool;
}
