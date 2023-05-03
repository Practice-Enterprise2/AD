<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property User $customer
 * @property string $email
 * @property ?Shipment $shipment
 * @property string $subject
 * @property string $message
 * @property bool $is_handled
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class CustomerContact extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    public const VALIDATION_RULE_EMAIL = ['required', 'email'];

    public const VALIDATION_RULE_SUBJECT = ['required'];

    public const VALIDATION_RULE_MESSAGE = ['required'];

    public const VALIDATION_RULE_IS_HANDLED = ['required', 'boolean'];

    public const VALIDATION_RULES = [
        'email' => self::VALIDATION_RULE_EMAIL,
        'subject' => self::VALIDATION_RULE_SUBJECT,
        'message' => self::VALIDATION_RULE_MESSAGE,
        'is_handled' => self::VALIDATION_RULE_IS_HANDLED,
    ];

    protected $fillable = [
        'email',
        'subject',
        'message',
        'is_handled',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
}
