<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property Shipment $shipment
 * @property Address $current_address
 * @property Address $next_address
 * @property string $status
 * @property ?\Illumiate\Support\Carbon $created_at
 * @property ?\Illumiate\Support\Carbon $updated_at
 */
class Waypoint extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    public const VALIDATION_RULE_STATUS = ['required', 'in:In Transit,Out For Delivery,Delivered,Exception'];

    public const VALIDATION_RULE_ARRAY = ['required', 'array'];

    public const VALIDATION_RULES = [
        'array' => self::VALIDATION_RULE_ARRAY,
        'status' => self::VALIDATION_RULE_STATUS,
        'current_address.street' => Address::VALIDATION_RULE_STREET,
        'current_address.house_number' => Address::VALIDATION_RULE_HOUSE_NUMBER,
        'current_address.city' => Address::VALIDATION_RULE_CITY,
        'current_address.postal_code' => Address::VALIDATION_RULE_POSTAL_CODE,
        'current_address.region' => Address::VALIDATION_RULE_REGION,
        'current_address.country' => Address::VALIDATION_RULE_COUNTRY,
        'next_address.street' => Address::VALIDATION_RULE_STREET,
        'next_address.house_number' => Address::VALIDATION_RULE_HOUSE_NUMBER,
        'next_address.city' => Address::VALIDATION_RULE_CITY,
        'next_address.postal_code' => Address::VALIDATION_RULE_POSTAL_CODE,
        'next_address.region' => Address::VALIDATION_RULE_REGION,
        'next_address.country' => Address::VALIDATION_RULE_COUNTRY,
    ];

    protected $fillable = [
        'status',
    ];

    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    public function current_address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'current_address_id', 'id');
    }

    public function next_address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'next_address_id', 'id');
    }
}
