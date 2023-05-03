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

    public const VALIDATION_RULES = [
        'status' => self::VALIDATION_RULE_STATUS,
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
