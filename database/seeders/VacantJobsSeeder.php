<?php

namespace Database\Seeders;

use App\Models\JobVacancy;
use Illuminate\Database\Seeder;

class VacantJobsSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = collect([
            //jobs
            ['title' => 'Project Manager', 'department' => 'Project Management', 'description' => 'We are seeking a skilled Project Manager to lead and oversee the successful delivery of projects within our organization. In this role, you will be responsible for planning, executing, and closing projects, managing resources, mitigating risks, and ensuring project goals are achieved on time and within budget. The ideal candidate should have excellent organizational and leadership skills, a proven track record in project management, and the ability to effectively communicate and collaborate with stakeholders.'],
            ['title' => 'Network Administrator', 'department' => 'IT', 'description' => 'We are seeking a skilled Network Administrator to maintain and optimize our organization\'s network infrastructure. In this role, you will be responsible for configuring and monitoring network equipment, troubleshooting network issues, implementing security measures, and ensuring network performance and reliability. The ideal candidate should have strong knowledge of network protocols and technologies, experience with network administration tools, and the ability to handle multiple priorities in a fast-paced environment.'],
            ['title' => 'Social Media Manager', 'department' => 'Marketing', 'description' => 'We are seeking a Social Media Manager to develop and implement social media strategies to enhance our brand presence and engage with our target audience. In this role, you will create and curate engaging content, manage social media platforms, monitor social media trends, and analyze campaign performance. The ideal candidate should have a deep understanding of various social media platforms, excellent communication skills, and the ability to develop creative and impactful social media campaigns.'],
        ]);

        foreach ($jobs as $job_object) {
            $job = new JobVacancy();

            $job->title = $job_object['title'];
            $job->department = $job_object['department'];
            $job->description = $job_object['description'];
            $job->push();
        }
    }
}
