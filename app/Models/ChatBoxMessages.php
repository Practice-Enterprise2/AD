<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property ChatBox $chatbox
 * @property User $from
 * @property string $content
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class ChatBoxMessages extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    public const VALIDATION_RULE_CONTENT = ['required'];

    public const VALIDATION_RULES = [
        'content' => self::VALIDATION_RULE_CONTENT,
    ];

    protected $fillable = [
        'content',
    ];

    public function chatbox()
    {
        return $this->belongsTo(ChatBox::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
