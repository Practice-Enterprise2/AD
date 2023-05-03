<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ticketID
 * @property int $cstID
 * @property int $employeeID
 * @property string $issue
 * @property string $description
 * @property string $solution
 * @property string $status
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Ticket extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    protected $primaryKey = 'ticketID';

    protected $fillable = [
        'cstID',
        'employeeID',
        'issue',
        'description',
        'solution',
        'status',
    ];
}
