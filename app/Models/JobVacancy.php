<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobVacancy extends Model
{
    use HasFactory;

    protected $table = 'job_vacancies';

    protected $fillable = [
        'title',
        'department',
        'description',
        'filled_at',
    ];

    public function appliedPeople(): HasMany
    {
        return $this->hasMany(AppliedPeople::class);
    }
}