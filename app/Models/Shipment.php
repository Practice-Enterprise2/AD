<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    use SoftDeletes, AppValidatesAttributes, HasFactory;

    public const VALIDATION_RULE_WEIGHT = ['required', 'numeric'];

    public const VALIDATION_RULE_SHIPMENT_DATE = ['required'];

    public const VALIDATION_RULE_DELIVERY_DATE = ['required'];

    public const VALIDATION_RULE_EXPENSE = ['required', 'numeric'];

    public const VALIDATION_RULE_TYPE = ['required', 'numeric'];

    public const VALIDATION_RULE_STATUS = ['required', 'in:Awaiting Confirmation,Awaiting Pickup,In Transit,Out For Delivery,Delivered,Exception,Held At Location,Deleted,Declined'];

    public const VALIDATION_RULES = [
        'shipment_date' => self::VALIDATION_RULE_SHIPMENT_DATE,
        'delivery_date' => self::VALIDATION_RULE_DELIVERY_DATE,
        'expense' => self::VALIDATION_RULE_EXPENSE,
        'weight' => self::VALIDATION_RULE_WEIGHT,
        'type' => self::VALIDATION_RULE_TYPE,
        'user.name' => User::VALIDATION_RULE_NAME,
        'user.email' => User::VALIDATION_RULE_EMAIL,
        'source_address.street' => Address::VALIDATION_RULE_STREET,
        'source_address.house_number' => Address::VALIDATION_RULE_HOUSE_NUMBER,
        'source_address.city' => Address::VALIDATION_RULE_CITY,
        'source_address.postal_code' => Address::VALIDATION_RULE_POSTAL_CODE,
        'source_address.region' => Address::VALIDATION_RULE_REGION,
        'source_address.country' => Address::VALIDATION_RULE_COUNTRY,
        'destination_address.street' => Address::VALIDATION_RULE_STREET,
        'destination_address.house_number' => Address::VALIDATION_RULE_HOUSE_NUMBER,
        'destination_address.city' => Address::VALIDATION_RULE_CITY,
        'destination_address.postal_code' => Address::VALIDATION_RULE_POSTAL_CODE,
        'destination_address.region' => Address::VALIDATION_RULE_REGION,
        'destination_address.country' => Address::VALIDATION_RULE_COUNTRY,
        'status' => self::VALIDATION_RULE_STATUS,
        'dimension.width' => Dimension::VALIDATION_RULE_WIDTH,
        'dimension.height' => Dimension::VALIDATION_RULE_HEIGHT,
        'dimension.length' => Dimension::VALIDATION_RULE_LENGTH,
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
