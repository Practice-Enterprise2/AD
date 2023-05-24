<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property Shipment $shipment
 * @property Address $address
 * @property \Illuminate\Support\Carbon $time
 * @property string $status
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 * @property ?\Illuminate\Support\Carbon $deleted_at
 */
class Pickup extends Model implements ValidatesAttributes
{
    use SoftDeletes, AppValidatesAttributes, HasFactory;

    public const VALIDATION_RULE_TIME = ['required'];

    public const VALIDATION_RULE_STATUS = ['in:pending,completed,canceled'];

    public const VALIDATION_RULES = [
        'time' => self::VALIDATION_RULE_TIME,
        'status' => self::VALIDATION_RULE_STATUS,
    ];

    protected $attributes = [
        'status' => 'pending',
    ];

    protected $fillable = [
        'time',
        'status',
    ];

    /*
     * The address where the pickup happens.
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    /*
     * The shipment that this is a pickup for.
     */
    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }
}
