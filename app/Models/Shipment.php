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

    public const VALIDATION_RULE_SHIPMENT_DATE = ['required'];

    public const VALIDATION_RULE_DELIVERY_DATE = ['required'];

    public const VALIDATION_RULE_EXPENSE = ['required', 'numeric'];

    public const VALIDATION_RULE_WEIGHT = ['required', 'numeric'];

    public const VALIDATION_RULE_TYPE = ['required', 'numeric'];

    public const VALIDATION_RULE_RECEIVER_NAME = [];

    public const VALIDATION_RULE_RECEIVER_EMAIL = ['email'];

    public const VALIDATION_RULE_STATUS = ['required', 'in:Awaiting Confirmation,Awaiting Pickup,In Transit,Out For Delivery,Delivered,Exception,Held At Location,Deleted,Declined'];

    public const VALIDATION_RULES = [
        'shipment_date' => self::VALIDATION_RULE_SHIPMENT_DATE,
        'delivery_date' => self::VALIDATION_RULE_DELIVERY_DATE,
        'expense' => self::VALIDATION_RULE_EXPENSE,
        'weight' => self::VALIDATION_RULE_WEIGHT,
        'type' => self::VALIDATION_RULE_TYPE,
        'receiver_name' => self::VALIDATION_RULE_RECEIVER_NAME,
        'receiver_email' => self::VALIDATION_RULE_RECEIVER_EMAIL,
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
