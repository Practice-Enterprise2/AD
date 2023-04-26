<?php

return [
    /**
     * Path to the laravel pint script.
     */
    'laravel_pint_path' => env('LARAVEL_PINT_PATH', './vendor/bin/pint'),

    /**
     * Path to the prettier script.
     */
    'prettier_path' => env('PRETTIER_PATH', './node_modules/prettier/bin-prettier.js'),

    /**
     * Path to the blade-formatter script.
     */
    'blade_formatter_path' => env('BLADE_FORMATTER_PATH', './node_modules/blade-formatter/bin/blade-formatter'),

    /**
     * Path to the psalm script.
     */
    'psalm_path' => env('PSALM_PATH', './vendor/bin/psalm'),
];
