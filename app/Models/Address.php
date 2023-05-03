<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
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
    use AppValidatesAttributes;

    public const VALIDATION_RULE_STREET = ['required', 'min:2'];

    public const VALIDATION_RULE_HOUSE_NUMBER = ['required', 'min:1'];

    public const VALIDATION_RULE_POSTAL_CODE = ['required', 'min:2'];

    public const VALIDATION_RULE_CITY = ['required', 'min:2'];

    public const VALIDATION_RULE_REGION = ['required', 'min:2'];

    public const VALIDATION_RULE_COUNTRY = ['required', 'min:2'];

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
