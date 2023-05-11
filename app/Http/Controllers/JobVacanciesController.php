<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;

class JobVacanciesController extends Controller
{
    public function add_job(Request $req)
    {
        $this->validate($req, [
            'job_title' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'job_department' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'job_description' => ['required', 'string'],
        ]);

        $jobVacancy = JobVacancy::create([
            'title' => $req->job_title,
            'department' => $req->job_department,
            'description' => $req->job_description,
        ]);
        $jobVacancy->save();

        return redirect()->back();
    }

    public function get_jobs()
    {
        $jobVacancies = JobVacancy::where('filled', false)->get();

        return view('job-vacancies.view_jobs', compact('jobVacancies'));
    }
}
