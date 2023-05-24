<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $street
 * @property string $house_number
 * @property string $postal_code
 * @property string $city
 * @property string $region
 * @property string $country
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Address extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes,HasFactory;

    public const VALIDATION_RULE_STREET = ['required', 'string', 'regex:/^[A-Za-z0-9\s\p{L}\-]+$/u', 'min:2'];

    public const VALIDATION_RULE_HOUSE_NUMBER = ['required', 'string', 'min:1'];

    public const VALIDATION_RULE_POSTAL_CODE = ['required', 'string', 'regex:/^[A-Za-z0-9\s\p{L}]+$/u', 'min:2'];

    public const VALIDATION_RULE_CITY = ['required', 'string', 'regex:/^[\p{L}\s\-]+$/u', 'min:2'];

    public const VALIDATION_RULE_REGION = ['required', 'string', 'regex:/^[\p{L}\s\-]+$/u', 'min:2'];

    public const VALIDATION_RULE_COUNTRY = ['required', 'string', 'regex:/^[\p{L}\s]+$/u', 'min:2'];

    public const VALIDATION_RULES = [
        'street' => self::VALIDATION_RULE_STREET,
        'house_number' => self::VALIDATION_RULE_HOUSE_NUMBER,
        'postal_code' => self::VALIDATION_RULE_POSTAL_CODE,
        'city' => self::VALIDATION_RULE_CITY,
        'region' => self::VALIDATION_RULE_REGION,
        'country' => self::VALIDATION_RULE_COUNTRY,
    ];

    protected $attributes = [
        'house_number' => '',
    ];

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

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function airport(): HasOne
    {
        return $this->hasOne(Airport::class);
    }

    public function depot(): HasOne
    {
        return $this->hasOne(Depot::class);
    }

    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }

    public function waypoints(): HasMany
    {
        return $this->hasMany(Waypoint::class);
    }
}
