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

    public const VALIDATION_RULE_STREET = ['required', 'string', 'regex:/^[A-Za-z0-9\s]+$/'];

    public const VALIDATION_RULE_HOUSENUMBER = ['required', 'string'];

    public const VALIDATION_RULE_POSTALCODE = ['required', 'string', 'regex:/^[A-Za-z0-9\s]+$/'];

    public const VALIDATION_RULE_CITY = ['required', 'string', 'regex:/^[A-Za-z\s]+$/'];

    public const VALIDATION_RULE_REGION = ['required', 'string', 'regex:/^[A-Za-z\s]+$/'];

    public const VALIDATION_RULE_COUNTRY = ['required', 'string', 'regex:/^[A-Za-z\s]+$/'];

    public const VALIDATION_RULE_ARRAY = ['required', 'array'];

    public const VALIDATION_RULES = [
        'array' => self::VALIDATION_RULE_ARRAY,
        'status' => self::VALIDATION_RULE_STATUS,
        'street' => self::VALIDATION_RULE_STREET,
        'house_number' => self::VALIDATION_RULE_HOUSENUMBER,
        'postal_code' => self::VALIDATION_RULE_POSTALCODE,
        'city' => self::VALIDATION_RULE_CITY,
        'region' => self::VALIDATION_RULE_REGION,
        'country' => self::VALIDATION_RULE_COUNTRY,
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
