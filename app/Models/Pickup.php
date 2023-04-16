<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/*
 * Model for the `pickups` table.
 */
class Pickup extends Model
{
    // Never delete records, add `deleted_at` column instead.
    use HasFactory;
    use SoftDeletes;

    // By adding this and a `public function prunable(): Builder`, the
    // corresponding table can be pruned periodically, by returning the no
    // longer needed records from the `prunable()` method. A `protected function
    // pruning(): void` can also be added which will be called just before the
    // pruning happens.
    // use Prunable;

    // Same as Prunable, but `pruning()` method can't be called as this uses
    // mass pruning statements.
    // use MassPrunable;

    // Table name (inherited).
    // protected $table = 'pickups';

    // Primary key (inherited).
    // protected $primaryKey = 'id';

    // Primary key incrementing (default).
    // public $incrementing = true;

    // Primary key type (default).
    // protected $keyType = 'bigint';

    // Timestamps (created_at & updated_at columns) (default).
    // public $timestamps = true;

    // The format in which dates are kept (default unkown).
    // protected $dateFormat;

    // Names for the timestamps columns (defaults)
    // const CREATED_AT = 'created_at';
    // const UPDATED_AT = 'updated_at';

    // Name of the database connection for this model (default)
    // protected $connection = 'mysql';

    // Default values for attributes when creating a new model.
    // protected $attributes = [];

    // Mass assignable attributes.
    protected $fillable = [
        'time',
        'status',
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    /*
     * The shipment for which this is a pickup.
     */
    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    // Guarded attributes.
    // protected $guarded = []
}
