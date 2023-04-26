<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property User $user
 * @property \Illuminate\Support\Carbon $dateOfBirth
 * @property string $jobTitle
 * @property int $salary
 * @property string $Iban
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 * @property ?\Illuminate\Support\Carbon $deleted_at
 */
class Employee extends Model
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $table = 'employees';

    protected $fillable = [
        'dateOfBirth',
        'jobTitle',
        'salary',
        'Iban',
    ];
}
