<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use HasFactory;

    public const VALIDATION_RULE_STREET = ['required', 'min:2'];

    public const VALIDATION_RULE_HOUSE_NUMBER = ['required', 'min:1'];

    public const VALIDATION_RULE_POSTAL_CODE = ['required', 'min:2'];

    public const VALIDATION_RULE_CITY = ['required', 'min:2'];

    public const VALIDATION_RULE_REGION = ['required', 'min:2'];

    public const VALIDATION_RULE_COUNTRY = ['required', 'min:2'];

    protected $fillable = [
        'street',
        'house_number',
        'postal_code',
        'city',
        'region',
        'country',
    ];

    public function pickups(): HasMany
    {
        return $this->hasMany(Pickup::class);
    }
}
