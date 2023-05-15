<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-2 grid gap-2 md:grid-cols-2">
                        <h4 class="text-2xl font-bold dark:text-white">Vacant Jobs</h4>
                        <div class="my-2 flex justify-end gap-4 px-4">
                            <a href="{{ route('job.add') }}" class="block rounded-lg bg-gray-200 px-[16px] py-[6px] text-gray-900 text-center" style="width: 100px;">Add Job</a>
                        </div>
                    </div>
                    <div class="my-1">
                        <table class="w-full">
                            <tr>
                                <th class="text-center border-b-2 text-lg h-13">Title</th>
                                <th class="text-center border-b-2 text-lg h-13">Department</th>
                                <th class="text-center border-b-2 text-lg h-13">Applicants</th>
                                <th class="text-center border-b-2 text-lg h-13"></th>
                            </tr>
                            @foreach ($jobVacancies as $job)
                                <tr>
                                    <td class="mt-3 text-center h-10">{{ $job->title }}</td>
                                    <td class="mt-3 text-center h-10">{{ $job->department }}</td>
                                    <td class="mt-3 text-center h-10">{{ $job->applicantCount }}</td>
                                    <td class="mt-3 text-center h-10" style="width: 100px;">
                                        <a href="{{ route('open_job', $job->id) }}" class="block rounded-lg bg-gray-200 px-[16px] py-[6px] text-gray-900 text-center">
                                            view
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>