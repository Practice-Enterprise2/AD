<?php

namespace App\Http\Controllers;

use App\Models\AppliedPeople;
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

    public function open_job($job)
    {
        $job_details = JobVacancy::where('id', $job)->where('filled', false)->get();

        if($job_details->count() == 0) {
            return redirect()->route('view_jobs');
        }

        return view('Job-vacancies.apply_job', compact('job'));
    }

    public function apply_job(Request $req, $job)
    {
        $job_details = JobVacancy::where('id', $job)->where('filled', false)->get();
        if($job_details->count() == 0) {
            return redirect()->route('view_jobs');
        }

        $this->validate($req, [
            'aplicant_name' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'aplicant_email' => ['required', 'email'],
            'job_description' => ['required', 'mimes:pdf', 'max:2048'],
        ]);
        $applicationDate = now();

        $applyJob = AppliedPeople::create([
            'job_vacancies_id' => $job,
            'name' => $req->applicant_name,
            'contact_info' => $req->applicant_email,
            'cv' => $req->applicant_cv,
            'application_date' => $applicationDate,
        ]);
        $applyJob->save();

        return redirect()->route('home');
    }
}
