<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacancyApplications extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'cv',
        'application_date',
    ];

    public function jobVacancy()
    {
        return $this->belongsTo(JobVacancy::class, 'job_vacancies_id');
    }
}
