<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedPeople extends Model
{
    protected $fillable = [
        'name',
        'contact_info',
        'cv',
        'application_date',
    ];

    public function jobVacancy()
    {
        return $this->belongsTo(JobVacancy::class, 'job_vacancies_id');
    }
}
