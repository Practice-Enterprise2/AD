<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use App\Models\VacancyApplications;
use Illuminate\Http\Request;

class JobVacanciesController extends Controller
{
    public function get_jobs_hr()
    {
        $jobVacancies = JobVacancy::where('filled', false)->get();

        foreach ($jobVacancies as $job) {
            $job->applicantCount = VacancyApplications::where('job_vacancies_id', $job->id)->count();
        }

        return view('job-vacancies.view_jobs_hr', ['jobVacancies' => $jobVacancies]);
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

        return redirect()->route('hr_view_jobs');
    }

    public function view_applicants($job)
    {
        $applicants = VacancyApplications::where('job_vacancies_id', $job)->get();
        foreach ($applicants as $applicant) {
            $applicant->job = $job;
        }

        return view('Job-vacancies.view_applicants', ['applicants' => $applicants]);
    }

    public function mark_filled(Request $req)
    {
        $req->job_id;
        $jobVacancy = JobVacancy::find($req->job_id);

        if ($jobVacancy) {
            $jobVacancy->filled = true; // Update the 'filled' field to true
            $jobVacancy->save();
        }

        return redirect()->route('hr_view_jobs');
    }

    public function open_cv($applicant)
    {
        $person = VacancyApplications::where('id', $applicant)->first();
        $cvPath = storage_path('app/public/'.$person->cv);

        if (file_exists($cvPath)) {
            // Get the file content
            $fileContents = file_get_contents($cvPath);

            // Generate a response with the file content and appropriate headers
            return response($fileContents, 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="cv.pdf"');
        } else {
            // Handle the case when the file does not exist
            abort(404, 'PDF file not found');
        }
    }

    public function get_jobs_applicant()
    {
        $jobVacancies = JobVacancy::where('filled', false)->get();

        return view('job-vacancies.view_jobs_applicants', ['jobVacancies' => $jobVacancies]);
    }

    public function open_job($job)
    {
        $job_details = JobVacancy::where('id', $job)->where('filled', false)->get();

        if ($job_details->count() == 0) {
            return redirect()->route('view_jobs');
        }

        return view('Job-vacancies.apply_job', ['job' => $job]);
    }

    public function apply_job(Request $req)
    {
        $this->validate($req, [
            'job_id' => ['required', 'numeric'],
            'applicant_first_name' => ['required', 'alpha'],
            'applicant_last_name' => ['required', 'alpha'],
            'applicant_email' => ['required', 'email'],
            'applicant_cv' => ['required', 'file', 'mimes:pdf',  'max:2048'],
        ]);
        $applicationDate = now();

        $job_details = JobVacancy::where('id', $req->job_id)->where('filled', false)->get();
        if ($job_details->count() == 0) {
            return redirect()->route('view_jobs')->withErrors(['error' => 'The job was recently filled.']);
        }

        $lastApplicant = VacancyApplications::latest()->first();
        if ($lastApplicant == '') {
            $lastApplicantID = 1;
        } else {
            $lastApplicantID = $lastApplicant->id + 1;
        }

        $file = $lastApplicantID.'-'.$req->applicant_name.'.pdf';
        $cvPath = $req->file('applicant_cv')->storeAs('cv', $file, 'public');

        $applyJob = new VacancyApplications();
        $applyJob->setAttribute('job_vacancies_id', $req->job_id);
        $applyJob->setAttribute('first_name', $req->applicant_first_name);
        $applyJob->setAttribute('last_name', $req->applicant_last_name);
        $applyJob->setAttribute('email', $req->applicant_email);
        $applyJob->setAttribute('cv', $cvPath);
        $applyJob->setAttribute('application_date', $applicationDate);
        $applyJob->save();

        return redirect()->route('view_jobs')->withErrors(['error' => 'Application is send.']);
    }
}
