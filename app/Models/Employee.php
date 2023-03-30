<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'employees';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'street',
        'province',
        'city',
        'postalCode',
        'phoneNumber',
        'mail',
        'dateOfBirth',
        'jobTitle',
        'salary',
        'isActive',
        'password',
        'Iban',
        'created_at',
        'updated_at',

    ];
}
