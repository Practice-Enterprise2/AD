<x-app-layout>
  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div
        class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <h4 class="text-2xl font-bold dark:text-white">complaint</h4><br>
          <form action="{{ route('sendEmployeeComplaint') }}" method="post">
            @csrf
            <div class="mb-6 grid gap-2 md:grid-cols-2">
              <x-text-input id="first_name" class="mt-1 block w-full p-[10px]"
                type="text" name="first_name" :value="old('first_name')"
                placeholder="first name" />
              <x-text-input id="last_name" class="mt-1 block w-full p-[10px]"
                type="text" name="last_name" :value="old('last_name')"
                placeholder="last name" />
              <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
              <x-input-error :messages="$errors->get('last_name')" class="mt-2" />

              <x-text-input id="email"
                class="row-start-3 mt-1 block w-full p-[10px]" type="email"
                name="email" :value="old('email')" placeholder="email address" />
              <x-text-input id="jobtitle"
                class="row-start-3 mt-1 block w-full p-[10px]" type="text"
                name="jobtitle" :value="old('jobtitle')" placeholder="job title" />
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
              <x-input-error :messages="$errors->get('jobtitle')" class="mt-2" />
            </div>
            <div class="mb-6 grid gap-2 md:grid-cols-1">
              <x-text-input id="location" class="mt-1 block w-full p-[10px]"
                type="text" name="location" :value="old('location')"
                placeholder="location of the incident" />
              <x-input-error :messages="$errors->get('location')" class="mt-2" />

              <x-text-input id="shortDis" class="mt-1 block w-full p-[10px]"
                type="text" name="shortDis" :value="old('shortDis')"
                placeholder="short discription of the incident*" required />
              <x-input-error :messages="$errors->get('shortDis')" class="mt-2" />

              <textarea id="discription" name="discription" rows="4"
                class="mt-1 block w-full rounded-lg bg-gray-900 p-[10px]"
                placeholder="detailed discription of the incident*" required>{{ old('discription') }}</textarea>
              <x-input-error :messages="$errors->get('discription')" class="mt-2" />
            </div>
            <div class="flex items-center gap-4">
              <button type="submit"
                class="block rounded-lg bg-gray-200 px-[16px] py-[6px] text-gray-900">Send</button>
              <button type="reset"
                class="block rounded-lg bg-gray-200 px-[16px] py-[6px] text-gray-900">Clear</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
