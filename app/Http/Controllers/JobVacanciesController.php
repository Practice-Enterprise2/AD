<?php

namespace App\Http\Controllers;

use App\Models\AppliedPeople;
use App\Models\JobVacancy;
use Illuminate\Http\Request;

class JobVacanciesController extends Controller
{
    public function get_jobs_hr()
    {
        $jobVacancies = JobVacancy::where('filled', false)->get();

        foreach ($jobVacancies as $job)
        {
            $job->applicantCount = AppliedPeople::where('job_vacancies_id', $job->id)->count();
        }

        return view('job-vacancies.view_jobs_hr', compact('jobVacancies'));
    }

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

    public function get_jobs_applicant()
    {
        $jobVacancies = JobVacancy::where('filled', false)->get();

        return view('job-vacancies.view_jobs_applicants', compact('jobVacancies'));
    }

    public function open_job($job)
    {
        $job_details = JobVacancy::where('id', $job)->where('filled', false)->get();

        if ($job_details->count() == 0) {
            return redirect()->route('view_jobs');
        }

        return view('Job-vacancies.apply_job', compact('job'));
    }

    public function apply_job(Request $req)
    {
        $this->validate($req, [
            'job_id' => ['required', 'numeric'],
            'applicant_name' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'applicant_email' => ['required', 'email'],
            'applicant_cv' => ['required', 'ends_with:.pdf',  'max:2048'],
        ]);
        $applicationDate = now();

        $job_details = JobVacancy::where('id', $req->job_id)->where('filled', false)->get();
        if ($job_details->count() == 0) {
            return redirect()->route('view_jobs')->withErrors(['error' => 'The job was recently filled.']);
        }

        $applyJob = AppliedPeople::create([
            'job_vacancies_id' => $req->job_id,
            'name' => $req->applicant_name,
            'contact_info' => $req->applicant_email,
            'cv' => $req->applicant_cv,
            'application_date' => $applicationDate,
        ]);
        $applyJob->save();

        return redirect()->route('view_jobs')->withErrors(['error' => 'Application is send.']);
    }
}
