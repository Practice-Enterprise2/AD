<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $code
 * @property Address $address
 * @property int $size
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Depot extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    protected $fillable = [
        'code',
        'size',
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
