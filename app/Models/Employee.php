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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //easily retrieve Employee associated with Shift by calling the employee method on a Shift instance.
    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }
}
