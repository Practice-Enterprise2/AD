<x-app-layout>
  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <h4 class="text-2xl font-bold dark:text-white">vacant jobs</h4><br>
          @foreach ($jobVacancies as $job)
          <div class="border-solid 	border-b border-sky-500 my-1">
            <div class="mb-2 grid gap-2 md:grid-cols-2">
                <p class="px-3 py-1">
                    {{ $job->title }}
                </p>
                <p class="px-3 py-1">
                    {{ $job->department }}
                </p>
            </div>
            <p class="px-3 py-1">
                {{ $job->description }}
            </p>
            <div class="gap-4 my-2 px-4 flex justify-end">
                <a href="{{ route('apply', $job) }}" class="block rounded-lg bg-gray-200 px-[16px] py-[6px] text-gray-900">apply for job</a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</x-app-layout>