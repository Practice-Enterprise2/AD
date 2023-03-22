<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">User ID</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Role</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="px-4 py-2 text-center">{{ $user->id }}</td>
                                <td class="px-4 py-2 text-center">
                                    <span id="name-{{ $user->id }}" class="name-span">{{ $user->name }}</span>
                                    <input id="edit-name-{{ $user->id }}" class="hidden edit-name-input" type="text" value="{{ $user->name }}">
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <span id="email-{{ $user->id }}" class="email-span">{{ $user->email }}</span>
                                    <input id="edit-email-{{ $user->id }}" class="hidden edit-email-input" type="email" value="{{ $user->email }}">
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <span id="role-{{ $user->id }}" class="role-span">{{ $user->roles->first()->name }}</span>
                                    <select id="edit-role-{{ $user->id }}" class="hidden edit-role-input" type="text" value="{{ $user->roles->first()->name}}">
                                    @foreach($user->roles as $role)
                                        <option id="role-option-{{ $role->first()->id }}">{{$role->first()->name}}</option>
                                    @endforeach
                                    </select>
                                </td>
                                <td class="px-4 py-2">
                                    <button data-id="{{ $user->id }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded edit-button">
                                        Edit
                                    </button>
                                    <button data-id="{{ $user->id }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded hidden save-button">
                                        Save
                                    </button>
                                </td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        <h3 class="text-lg font-medium mb-2">Add New User</h3>
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="flex items-center mb-4">
                                <label for="name" class="mr-4">Name:</label>
                                <input type="text" name="name" id="name" class="border rounded py-2 px-3">
                            </div>
                            <div class="flex items-center mb-4">
                                <label for="email" class="mr-4">Email:</label>
                                <input type="email" name="email" id="email" class="border rounded py-2 px-3">
                            </div>
                            <div class="flex items-center mb-4">
                                <label for="password" class="mr-4">Password:</label>
                                <input type="password" name="password" id="password" class="border rounded py-2 px-3">
                            </div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add User
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    const editButtons = document.querySelectorAll('.edit-button');
    const saveButtons = document.querySelectorAll('.save-button');
    const nameSpans = document.querySelectorAll('.name-span');
    const emailSpans = document.querySelectorAll('.email-span');
    const nameInputs = document.querySelectorAll('.edit-name-input');
    const emailInputs = document.querySelectorAll('.edit-email-input');
    
    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            const nameSpan = document.querySelector(`#name-${id}`);
            const emailSpan = document.querySelector(`#email-${id}`);
            const nameInput = document.querySelector(`#edit-name-${id}`);
            const emailInput = document.querySelector(`#edit-email-${id}`);
            const editButton = document.querySelector(`button[data-id="${id}"].edit-button`);
            const saveButton = document.querySelector(`button[data-id="${id}"].save-button`);
            
            nameSpan.classList.add('hidden');
            emailSpan.classList.add('hidden');
            nameInput.classList.remove('hidden');
            emailInput.classList.remove('hidden');
            editButton.classList.add('hidden');
            saveButton.classList.remove('hidden');
        });
    });
    
    saveButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            const nameSpan = document.querySelector(`#name-${id}`);
            const emailSpan = document.querySelector(`#email-${id}`);
            const nameInput = document.querySelector(`#edit-name-${id}`);
            const emailInput = document.querySelector(`#edit-email-${id}`);
            const editButton = document.querySelector(`button[data-id="${id}"].edit-button`);
            const saveButton = document.querySelector(`button[data-id="${id}"].save-button`);
            
            // Make AJAX call to update the user name and email
            fetch(`/admin/users/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    name: nameInput.value,
                    email: emailInput.value
                })
            })
            .then(response => response.json())
            .then(data => {
                // Update the name-span and email-span with the new name and email
                nameSpan.textContent = data.name;
                emailSpan.textContent = data.email;
                
                // Hide the edit-name-input and edit-email-input, and show the name-span and email-span
                nameSpan.classList.remove('hidden');
                emailSpan.classList.remove('hidden');
                nameInput.classList.add('hidden');
                emailInput.classList.add('hidden');
                editButton.classList.remove('hidden');
                saveButton.classList.add('hidden');
            })
            .catch((error) => {
                console.error(error);
            });
        });
    });
</script>
</x-app-layout>