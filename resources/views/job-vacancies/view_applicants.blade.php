<x-app-layout>
  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div
        class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <div class="mb-2 grid gap-2 md:grid-cols-2">
            <h4 class="text-2xl font-bold dark:text-white">Applicants</h4>
            <div class="my-2 flex justify-end gap-4 px-4">
              <form action="{{ route('JobVacanciesController.filled') }}"
                method="post">
                @csrf
                @foreach ($applicants as $applicant)
                  <input type="hidden" name="job_id" id="job_id"
                    value="{{ $applicant->job }}">
                @break
              @endforeach
              <button type="submit"
                class="block rounded-lg bg-gray-200 px-[16px] py-[6px] text-center text-gray-900"
                style="width: 145px;">Mark as Filled</button>
            </form>
          </div>
        </div>
        <div class="my-1">
          <table class="w-full">
            <tr>
              <th class="h-13 border-b-2 text-center text-lg">Name</th>
              <th class="h-13 border-b-2 text-center text-lg">Contact Info
              </th>
              <th class="h-13 border-b-2 text-center text-lg">CV</th>
            </tr>
            @foreach ($applicants as $applicant)
              <tr>
                <td class="mt-3 h-10 text-center">{{ $applicant->first_name }}
                  {{ $applicant->last_name }}</td>
                <td class="mt-3 h-10 text-center">
                  {{ $applicant->email }}</td>
                <td class="mt-3 h-10 text-center underline"><a
                    href="{{ route('open_cv', $applicant->id) }}"
                    target="_blank">cv</a></td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</x-app-layout>
