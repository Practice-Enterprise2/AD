<x-app-layout>
  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div
        class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <h4 class="text-2xl font-bold dark:text-white">apply for job</h4><br>
          <form method="post"
            action="{{ route('JobVacanciesController.apply') }}"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="job_id" id="job_id"
              value="{{ $job }}">
            <div class="mb-2 grid gap-2 md:grid-cols-2">
              <x-text-input id="applicant_first_name"
                class="mt-1 block w-full p-[10px]" type="text"
                name="applicant_first_name" :value="old('applicant_first_name')"
                placeholder="first name*" required />
              <x-text-input id="applicant_last_name"
                class="mt-1 block w-full p-[10px]" type="text"
                name="applicant_last_name" :value="old('applicant_last_name')"
                placeholder="last name*" required />
              <x-input-error :messages="$errors->get('applicant_first_name')" class="mt-2" />
              <x-input-error :messages="$errors->get('applicant_last_name')" class="mt-2" />
            </div>
            <div class="flex items-center gap-4">
              <x-text-input id="applicant_email"
                class="mt-1 block w-full p-[10px]" type="email"
                name="applicant_email" :value="old('applicant_email')" placeholder="e-mail*"
                required />
              <x-input-error :messages="$errors->get('applicant_email')" class="mt-2" />
              <x-text-input id="applicant_cv" class="mt-1 block w-full p-[10px]"
                type="file" name="applicant_cv" :value="old('applicant_cv')"
                accept=".pdf" required /></br>
              <x-input-error :messages="$errors->get('applicant_cv')" class="mt-2" />
              <button type="submit"
                class="block rounded-lg bg-gray-200 px-[16px] py-[6px] text-gray-900">apply</button>
              <button type="reset"
                class="block rounded-lg bg-gray-200 px-[16px] py-[6px] text-gray-900">clear</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
