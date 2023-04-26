<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chatBox extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'employee_id',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function messages()
    {
        return $this->hasMany(messages::class);
    }
}
