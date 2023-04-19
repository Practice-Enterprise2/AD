<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'employees';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'dateOfBirth',
        'jobTitle',
        'salary',
        'iban',
        'created_at',
        'updated_at',

    ];
}
