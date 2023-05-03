<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property Shipment $shipment
 * @property string $invoice_code
 * @property \Illuminate\Support\Carbon $due_date
 * @property float $total_price
 * @property float $total_price_excl_vat
 * @property bool $is_paid
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Invoice extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    protected $attributes = [
        'is_paid' => 0,
    ];

    protected $fillable = [
        'invoice_code',
        'due_date',
        'total_price',
        'total_price_excl_vat',
        'is_paid',
    ];

    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }
}
