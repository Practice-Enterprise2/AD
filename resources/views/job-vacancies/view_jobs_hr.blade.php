<x-app-layout>
  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div
        class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <div class="mb-2 grid gap-2 md:grid-cols-2">
            <h4 class="text-2xl font-bold dark:text-white">Vacant Jobs</h4>
            <div class="my-2 flex justify-end gap-4 px-4">
              <a href="{{ route('job.add') }}"
                class="block rounded-lg bg-gray-200 px-[16px] py-[6px] text-center text-gray-900"
                style="width: 100px;">Add Job</a>
            </div>
          </div>
          <div class="my-1">
            <table class="w-full">
              <tr>
                <th class="h-13 border-b-2 text-center text-lg">Title</th>
                <th class="h-13 border-b-2 text-center text-lg">Department</th>
                <th class="h-13 border-b-2 text-center text-lg">Applicants</th>
                <th class="h-13 border-b-2 text-center text-lg"></th>
              </tr>
              @foreach ($jobVacancies as $job)
                <tr>
                  <td class="mt-3 h-10 text-center">{{ $job->title }}</td>
                  <td class="mt-3 h-10 text-center">{{ $job->department }}</td>
                  <td class="mt-3 h-10 text-center">{{ $job->applicantCount }}
                  </td>
                  <td class="mt-3 h-10 text-center" style="width: 100px;">
                    @can('edit_vacant_jobs')
                      <a href="{{ route('view_applicants', $job->id) }}"
                        class="block rounded-lg bg-gray-200 px-[16px] py-[6px] text-center text-gray-900">
                        view
                      </a>
                    @endcan
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
