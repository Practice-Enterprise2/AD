<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property Address $source_address
 * @property Address $destination_address
 * @property \Illuminate\Support\Carbon $shipment_date
 * @property \Illuminate\Support\Carbon $delivery_date
 * @property int $expense
 * @property int $weight
 * @property string $type
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 * @property User $user
 * @property ?\Illuminate\Support\Carbon $deleted_at
 * @property ?string $receiver_name
 * @property ?string $receiver_email
 * @property string $status
 * @property Dimension $dimension
 */
class Shipment extends Model implements ValidatesAttributes
{
    use SoftDeletes, AppValidatesAttributes;

    public const VALIDATION_RULE_NAME = ['required', 'string', 'regex:/^[A-Za-z\s]+$/'];

    public const VALIDATION_RULE_SHIPMENT_DATE = ['required'];

    public const VALIDATION_RULE_DELIVERY_DATE = ['required'];

    public const VALIDATION_RULE_EXPENSE = ['required', 'numeric'];

    public const VALIDATION_RULE_TYPE = ['required', 'numeric'];

    public const VALIDATION_RULE_EMAIL = ['required', 'email', 'unique:users,email'];

    public const VALIDATION_RULE_STREET = ['required', 'string', 'regex:/^[A-Za-z0-9\s]+$/'];

    public const VALIDATION_RULE_HOUSENUMBER = ['required', 'string'];

    public const VALIDATION_RULE_POSTALCODE = ['required', 'string', 'regex:/^[A-Za-z0-9\s]+$/'];

    public const VALIDATION_RULE_CITY = ['required', 'string', 'regex:/^[A-Za-z\s]+$/'];

    public const VALIDATION_RULE_REGION = ['required', 'string', 'regex:/^[A-Za-z\s]+$/'];

    public const VALIDATION_RULE_COUNTRY = ['required', 'string', 'regex:/^[A-Za-z\s]+$/'];

    public const VALIDATION_RULE_STATUS = ['required', 'in:Awaiting Confirmation,Awaiting Pickup,In Transit,Out For Delivery,Delivered,Exception,Held At Location,Deleted,Declined'];

    public const VALIDATION_RULE_WIDTH = ['required', 'numeric'];

    public const VALIDATION_RULE_HEIGHT = ['required', 'numeric'];

    public const VALIDATION_RULE_LENGTH = ['required', 'numeric'];

    public const VALIDATION_RULE_WEIGHT = ['required', 'numeric'];

    public const VALIDATION_RULES = [
        'shipment_date' => self::VALIDATION_RULE_SHIPMENT_DATE,
        'delivery_date' => self::VALIDATION_RULE_DELIVERY_DATE,
        'expense' => self::VALIDATION_RULE_EXPENSE,
        'weight' => self::VALIDATION_RULE_WEIGHT,
        'type' => self::VALIDATION_RULE_TYPE,
        'name' => self::VALIDATION_RULE_NAME,
        'email' => self::VALIDATION_RULE_EMAIL,
        'street' => self::VALIDATION_RULE_STREET,
        'house_number' => self::VALIDATION_RULE_HOUSENUMBER,
        'postal_code' => self::VALIDATION_RULE_POSTALCODE,
        'city' => self::VALIDATION_RULE_CITY,
        'region' => self::VALIDATION_RULE_REGION,
        'country' => self::VALIDATION_RULE_COUNTRY,
        'status' => self::VALIDATION_RULE_STATUS,
        'width' => self::VALIDATION_RULE_WIDTH,
        'height' => self::VALIDATION_RULE_HEIGHT,
        'length' => self::VALIDATION_RULE_LENGTH,
    ];

    protected $fillable = [
        'shipment_date',
        'delivery_date',
        'expense',
        'weight',
        'type',
        'receiver_name',
        'receiver_email',
        'status',
    ];

    public function pickups(): HasMany
    {
        return $this->hasMany(Pickup::class);
    }

    public function source_address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function destination_address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function waypoints(): HasMany
    {
        return $this->hasMany(Waypoint::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dimension(): BelongsTo
    {
        return $this->belongsTo(Dimension::class);
    }
}
