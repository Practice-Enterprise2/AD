<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property User $user
 * @property string $vat_number
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 * @property ?\Illuminate\Support\Carbon $deleted_at
 */
class BusinessCustomer extends Model implements ValidatesAttributes
{
    use SoftDeletes, AppValidatesAttributes;

    public const VALIDATION_RULE_VAT_NUMBER = ['required', 'min:4'];

    public const VALIDATION_RULES = [
        'vat_number' => self::VALIDATION_RULE_VAT_NUMBER,
    ];

    protected $fillable = [
        'vat_number',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
