<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h4 class="text-2xl font-bold dark:text-white">complaint</h4><br>
                    <form action="{{ route('sendEmployeeComplaint.employee') }}" method="post">
                        @csrf
                        <div class="grid gap-2 mb-6 md:grid-cols-2">
                            <x-text-input id="first_name" class="block mt-1 w-full p-[10px]" type="text" name="first_name" :value="old('first_name')" placeholder="first name" />
                            <x-text-input id="last_name" class="block mt-1 w-full p-[10px]" type="text" name="last_name" :value="old('last_name')" placeholder="last name" />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />

                            <x-text-input id="email" class="block mt-1 w-full p-[10px] row-start-3" type="email" name="email" :value="old('email')" placeholder="email address" />
                            <x-text-input id="jobtitle" class="block mt-1 w-full p-[10px] row-start-3" type="text" name="jobtitle" :value="old('jobtitle')" placeholder="job title" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            <x-input-error :messages="$errors->get('jobtitle')" class="mt-2" />
                        </div>
                        <div class="grid gap-2 mb-6 md:grid-cols-1">
                            <x-text-input id="location" class="block mt-1 w-full p-[10px]" type="text" name="location" :value="old('location')" placeholder="location of the incident" />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />

                            <x-text-input id="shortDis" class="block mt-1 w-full p-[10px]" type="text" name="shortDis" :value="old('shortDis')" placeholder="short discription of the incident*" required />
                            <x-input-error :messages="$errors->get('shortDis')" class="mt-2" />

                            <textarea id="discription" name="discription" rows="4" class="block mt-1 w-full p-[10px] rounded-lg bg-gray-900" placeholder="detailed discription of the incident*" required>{{{ old('discription') }}}</textarea>
                            <x-input-error :messages="$errors->get('discription')" class="mt-2" />
                        </div>
                        <div class="flex items-center gap-4">
                            <button type="submit" class="block bg-gray-200 text-gray-900 rounded-lg px-[16px] py-[6px]">Send</button>
                            <button type="reset" class="block bg-gray-200 text-gray-900 rounded-lg px-[16px] py-[6px]">Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>