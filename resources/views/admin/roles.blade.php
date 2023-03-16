<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="border-1 border-black">
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                        </tr>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{ __($role['id']) }}</td>
                            <td>{{ __($role['name']) }}</td>
                        </tr>
                        @endforeach
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>