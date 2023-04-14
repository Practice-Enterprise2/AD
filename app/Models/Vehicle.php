<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< Updated upstream

class Vehicle extends Model
{
=======
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Hash;

class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;
>>>>>>> Stashed changes
    protected $table = 'vehicles';

    protected $primaryKey = 'id';

    protected $fillable = [
<<<<<<< Updated upstream
        'name',
        'type',
        'license_plate',
        'start_location',
        'end_location',
        'status',
    ];

    use HasFactory;
=======
        'type',
        'license_plate',
        'status',
        'deleted'
    ];

    
    public function airport_address_id(): HasOne
    {
        return $this->hasOne(Address::class, 'id', 'airport_address_id');
    }
    public function depot_address_id(): HasOne
    {
        return $this->hasOne(Address::class, 'id', 'depot_address_id');
    }
    public function driver_id(): HasOne
    {
         return $this->hasOne(Employee::class, 'id', 'driver_id');
    }
>>>>>>> Stashed changes
}
