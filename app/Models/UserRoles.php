<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsToMany(User::class);
    }
    protected $fillable = [
        'role_id',
        'user_id'
    ];
}
