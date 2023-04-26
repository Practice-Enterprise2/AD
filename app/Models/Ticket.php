<?php

namespace App\Models;

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
class Ticket extends Model
{
    protected $fillable = ['cstID', 'issue', 'description'];
}
