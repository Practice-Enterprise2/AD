{{-- -*-html-*- --}}

<x-app-layout>
  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div
        class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <div class="mb-4 w-1/4">
            <input type="text" id="search" name="search"
              placeholder="Search by name"
              class="block w-full rounded-md border-gray-300 pl-7 pr-12 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm sm:leading-5">
          </div>
          <table class="w-full table-auto">
            <thead>
              <tr>
                <th class="px-4 py-2">User ID</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Role</th>
                <th class="px-4 py-2" colspan="3">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr
                  class="{{ $user->is_locked ? 'bg-red-500 text-white' : '' }}">
                  <td class="px-4 py-2 text-center">{{ $user->id }}</td>
                  <td class="px-4 py-2 text-center">
                    <span id="name-{{ $user->id }}"
                      class="name-span">{{ $user->name }}</span>
                    <input id="edit-name-{{ $user->id }}"
                      class="edit-name-input hidden" type="text"
                      value="{{ $user->name }}">
                  </td>
                  <td class="px-4 py-2 text-center">
                    <span id="email-{{ $user->id }}"
                      class="email-span">{{ $user->email }}</span>
                    <input id="edit-email-{{ $user->id }}"
                      class="edit-email-input hidden" type="email"
                      value="{{ $user->email }}">
                  </td>
                  <td class="px-4 py-2 text-center">
                    <span id="role-{{ $user->id }}"
                      class="role-span">{{ $user->roles->first()->name }}</span>
                    <select id="edit-role-{{ $user->id }}"
                      class="edit-role-input hidden" type="text"
                      value="{{ $user->roles->first()->name }}">
                      @foreach ($roles as $role)
                        <option value="{{ $role }}"
                          {{ $role == $user->roles->first()->name ? 'selected' : '' }}>
                          {{ $role }}</option>
                      @endforeach
                    </select>
                  </td>
                  <td class="px-4 py-2">
                    <button data-id="{{ $user->id }}"
                      class="edit-button rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700">
                      Edit
                    </button>
                    <button data-id="{{ $user->id }}"
                      class="save-button hidden rounded bg-green-500 px-4 py-2 font-bold text-white hover:bg-green-700">
                      Save
                    </button>
                  </td>
                  {{-- Button to lock/ unlock accounts --}}
                  <td class="px-4 py-2">
                    @if ($user->roles->first()->name != 'admin')
                      <form
                        action="{{ route('users.toggle-lock', $user->id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                          class="rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700">
                          @if ($user->is_locked)
                            Unlock
                          @else
                            Lock
                          @endif
                        </button>
                      </form>
                    @endif
                  </td>

                  <td class="px-4 py-2">
                    <form action="{{ route('users.destroy', $user->id) }}"
                      method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        class="rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700">Delete</button>
                    </form>
                  </td>
                </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script>
    const editButtons = document.querySelectorAll('.edit-button');
    const saveButtons = document.querySelectorAll('.save-button');
    const nameSpans = document.querySelectorAll('.name-span');
    const emailSpans = document.querySelectorAll('.email-span');
    const roleSpans = document.querySelectorAll('.role-span');
    const nameInputs = document.querySelectorAll('.edit-name-input');
    const emailInputs = document.querySelectorAll('.edit-email-input');
    const roleInputs = document.querySelectorAll('.edit-role-input');

    editButtons.forEach(button => {
      button.addEventListener('click', () => {
        const id = button.dataset.id;
        const nameSpan = document.querySelector(`#name-${id}`);
        const emailSpan = document.querySelector(`#email-${id}`);
        const roleSpan = document.querySelector(`#role-${id}`);
        const nameInput = document.querySelector(`#edit-name-${id}`);
        const emailInput = document.querySelector(`#edit-email-${id}`);
        const roleInput = document.querySelector(`#edit-role-${id}`);
        const originalRole = roleSpan.innerText;

        nameSpan.classList.add('hidden');
        emailSpan.classList.add('hidden');
        roleSpan.classList.add('hidden');
        nameInput.classList.remove('hidden');
        emailInput.classList.remove('hidden');
        roleInput.classList.remove('hidden');
        roleInput.value = originalRole;

        button.classList.add('hidden');
        saveButtons.forEach(saveButton => {
          if (saveButton.dataset.id === id) {
            saveButton.classList.remove('hidden');
          }
        });
      });
    });

    saveButtons.forEach(button => {
      button.addEventListener('click', () => {
        const id = button.dataset.id;
        const nameSpan = document.querySelector(`#name-${id}`);
        const emailSpan = document.querySelector(`#email-${id}`);
        const roleSpan = document.querySelector(`#role-${id}`);
        const nameInput = document.querySelector(`#edit-name-${id}`);
        const emailInput = document.querySelector(`#edit-email-${id}`);
        const roleInput = document.querySelector(`#edit-role-${id}`);

        // make an AJAX request to update the user in the database
        axios.put(`/admin/users/${id}`, {
          name: nameInput.value,
          email: emailInput.value,
          role: roleInput.value,
        }).then(() => {
          // update the text of the name, email and role spans with the new values
          nameSpan.textContent = nameInput.value;
          emailSpan.textContent = emailInput.value;
          roleSpan.textContent = roleInput.value;

          // show the name and email spans, and hide the name and email inputs
          nameSpan.classList.remove('hidden');
          emailSpan.classList.remove('hidden');
          nameInput.classList.add('hidden');
          emailInput.classList.add('hidden');

          // show the role span, and hide the role input and the save button
          roleSpan.classList.remove('hidden');
          roleInput.classList.add('hidden');
          button.classList.add('hidden');

          // show the edit button
          document.querySelector(`.edit-button[data-id="${id}"]`)
            .classList.remove('hidden');
        }).catch((error) => {
          console.log(error);
        });
      });
    });
  </script>
  <script>
    const searchInput = document.querySelector('#search');

    searchInput.addEventListener('input', () => {
      const searchTerm = searchInput.value.trim().toLowerCase();
      const nameSpans = document.querySelectorAll('.name-span');

      nameSpans.forEach(nameSpan => {
        const name = nameSpan.textContent.trim().toLowerCase();

        if (name.includes(searchTerm)) {
          nameSpan.closest('tr').classList.remove('hidden');
        } else {
          nameSpan.closest('tr').classList.add('hidden');
        }
      });
    });
  </script>

  {{-- Add the following JavaScript code to your view or a separate JavaScript file --}}
  <script>
    // Attach a click event handler to the lock/unlock button
    document.querySelectorAll('.lock-button').forEach(function(button) {
      button.addEventListener('click', function() {
        // Get the user ID and current locked state from the button's data attributes
        var userId = button.dataset.id;
        var isLocked = button.dataset.locked === 'true';

        // Send an AJAX request to toggle the locked state in the database
        fetch('/users/' + userId + '/toggle-locked', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector(
                'meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
              is_locked: !isLocked
            })
          })
          .then(function(response) {
            if (response.ok) {
              // Toggle the locked state in the button's data attributes and text
              button.dataset.locked = !isLocked;
              button.textContent = isLocked ? 'Lock' : 'Unlock';

              // Toggle the background color of the user row
              var userRow = document.querySelector('#user-' + userId);
              userRow.classList.toggle('bg-red-200');
            }
          });
      });
    });
  </script>
</x-app-layout>
