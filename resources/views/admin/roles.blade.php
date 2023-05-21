{{-- -*-html-*- --}}

<x-app-layout>
  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div
        class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <table class="table-auto">
            <thead>
              <tr>
                <th class="px-4 py-2">Role ID</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($roles as $role)
                <tr>
                  <td class="px-4 py-2 text-center">{{ $role->id }}</td>
                  <td class="px-4 py-2 text-center">
                    <span id="name-{{ $role->id }}"
                      class="name-span">{{ $role->name }}</span>
                    <input id="edit-name-{{ $role->id }}"
                      class="edit-name-input hidden" type="text"
                      value="{{ $role->name }}">
                  </td>
                  <td class="px-4 py-2">
                    @if ($role->name !== 'user')
                      <button data-id="{{ $role->id }}"
                        class="edit-button rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700">
                        Edit
                      </button>
                      <button data-id="{{ $role->id }}"
                        class="save-button hidden rounded bg-green-500 px-4 py-2 font-bold text-white hover:bg-green-700">
                        Save
                      </button>
                    @endif
                  </td>
                  <td class="px-4 py-2">
                    @if ($role->name !== 'user')
                      <form action="{{ route('roles.destroy', $role->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                          class="rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700">Delete</button>
                      </form>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="mt-4">
            <h3 class="mb-2 text-lg font-medium">Add New Role</h3>
            <form action="{{ route('roles.store') }}" method="POST">
              @csrf
              <div class="mb-4 flex items-center">
                <label for="name" class="mr-4">Name:</label>
                <input type="text" name="name" id="name"
                  class="rounded border px-3 py-2">
              </div>
              <button type="submit"
                class="rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700">
                Add Role
              </button>
            </form>
          </div>
          <script>
            const editButtons = document.querySelectorAll('.edit-button');
            const saveButtons = document.querySelectorAll('.save-button');
            const nameSpans = document.querySelectorAll('.name-span');
            const nameInputs = document.querySelectorAll('.edit-name-input');
            editButtons.forEach(button => {
              button.addEventListener('click', () => {
                const id = button.dataset.id;
                const nameSpan = document.querySelector(`#name-${id}`);
                const nameInput = document.querySelector(`#edit-name-${id}`);
                const editButton = document.querySelector(
                  `button[data-id="${id}"].edit-button`);
                const saveButton = document.querySelector(
                  `button[data-id="${id}"].save-button`);

                nameSpan.classList.add('hidden');
                nameInput.classList.remove('hidden');
                editButton.classList.add('hidden');
                saveButton.classList.remove('hidden');
              });
            });

            saveButtons.forEach(button => {
              button.addEventListener('click', () => {
                const id = button.dataset.id;
                const nameSpan = document.querySelector(`#name-${id}`);
                const nameInput = document.querySelector(`#edit-name-${id}`);
                const editButton = document.querySelector(
                  `button[data-id="${id}"].edit-button`);
                const saveButton = document.querySelector(
                  `button[data-id="${id}"].save-button`);

                // Make AJAX call to update the role name
                fetch(`/admin/roles/${id}`, {
                    method: 'PUT',
                    headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': document.querySelector(
                        'meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                      name: nameInput.value
                    })
                  })
                  .then(response => response.json())
                  .then(data => {
                    // Update the name-span with the new name
                    nameSpan.textContent = data.name;

                    // Hide the edit-name-input and show the name-span
                    nameSpan.classList.remove('hidden');
                    nameInput.classList.add('hidden');
                    editButton.classList.remove('hidden');
                    saveButton.classList.add('hidden');
                  })
                  .catch((error) => {
                    console.error(error);
                  });
              });
            });
          </script>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
