<x-app-layout>
  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div
        class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <h4 class="text-2xl font-bold dark:text-white">add job</h4><br>
          <form method="post" action="{{ route('JobVacanciesController.add') }}">
            @csrf
            <div class="mb-2 grid gap-2 md:grid-cols-2">
              <x-text-input id="job_title" class="mt-1 block w-full p-[10px]"
                type="text" name="job_title" :value="old('job_title')"
                placeholder="job title*" required />
              <x-text-input id="job_department"
                class="mt-1 block w-full p-[10px]" type="text"
                name="job_department" :value="old('job_department')"
                placeholder="job department*" required />
            </div>
            <div class="mb-4 grid gap-2 md:grid-cols-1">
              <textarea id="job_description" name="job_description" rows="6"
                class="mt-1 block w-full rounded-lg bg-gray-900 p-[10px]"
                placeholder="job description*">{{ old('job_description') }}</textarea>
            </div>
            <div class="flex items-center gap-4">
              <button type="submit"
                class="block rounded-lg bg-gray-200 px-[16px] py-[6px] text-gray-900">submit</button>
              <button type="reset"
                class="block rounded-lg bg-gray-200 px-[16px] py-[6px] text-gray-900">clear</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
