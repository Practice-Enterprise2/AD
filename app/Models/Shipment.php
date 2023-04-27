<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

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
class Shipment extends Model
{
    protected $table = 'shipments';

    use HasFactory;
    use SoftDeletes;
    use Sortable;

    protected $primaryKey = 'id';

    public $sortable = [
        'receiver_name',
        'shipment_date',
        'delivery_date',
        'status',
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

    public function address()
    {
        return $this->belongsTo(Address::class);
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
