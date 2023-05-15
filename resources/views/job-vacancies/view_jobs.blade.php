<x-app-layout>
  @if ($errors->any())
    <script>
      alert('{{ $errors->first() }}');
    </script>
  @endif
  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div
        class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <h4 class="text-2xl font-bold dark:text-white">vacant jobs</h4><br>
          @foreach ($jobVacancies as $job)
            <div class="my-1 border-b border-solid border-sky-500">
              <form method="get" action="{{ route('open_job', $job->id) }}">
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
                <div class="my-2 flex justify-end gap-4 px-4">
                  <button type="submit"
                    class="block rounded-lg bg-gray-200 px-[16px] py-[6px] text-gray-900">apply
                    for job</button>
                </div>
              </form>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
