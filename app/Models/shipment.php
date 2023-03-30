<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Shipment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sortable;
    protected $primaryKey = 'id';
    protected $table='shipments';
    public $sortable = [
        'id',
        'name',
        'shipment_date',
        'delivery_date',
        'status',
    ];

    protected $fillable = [
        'name',
        'shipment_date',
        'delivery_date',
        'status',
        'expense',
        'weight',
        'type',
    ];

    public function source_address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function destination_address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
