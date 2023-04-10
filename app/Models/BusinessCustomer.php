<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusinessCustomer extends Model
{
    use HasFactory, SoftDeletes;

    public const VALIDATION_RULE_USER_ID = ['required', 'min:1'];
    public const VALIDATION_RULE_VAT_NUMBER = ['required', 'min:4'];

    protected $fillable = [
        'user_id',
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
