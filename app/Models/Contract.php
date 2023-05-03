<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property Airline $airline
 * @property Airport $depart_airport
 * @property Airport $destination_airport
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property int $price
 * @property bool $is_active
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Contract extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    protected $fillable = [
        'start_date',
        'end_date',
        'price',
        'is_active',
    ];

    public function absences(): HasMany
    {
        return $this->hasMany(Absence::class);
    }

    public function airline(): BelongsTo
    {
        return $this->belongsTo(Airline::class);
    }

    public function depart_airport(): BelongsTo
    {
        return $this->belongsTo(Airline::class);
    }

    public function destination_airport(): BelongsTo
    {
        return $this->belongsTo(Airline::class);
    }

    public function holiday_saldos(): HasMany
    {
        return $this->hasMany(HolidaySaldo::class);
    }
}
