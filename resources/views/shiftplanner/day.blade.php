<x-app-layout>
  <div class="py-12">
    <div class="mx-auto sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <h2 class="m-3 mb-4 text-2xl font-bold">Planning for {{ $date }}
        </h2>
        @foreach ($positions as $position)
          <div class="m-5 rounded-2xl border border-gray-500 p-3">
            <h3>{{ $position->name }}</h3>
            <table class="w-full table-auto bg-gray-100">
              <thead>
                <tr class="border-2 border-gray-500">
                  <th class="px-4 py-2">Employee Name</th>
                  <th class="px-4 py-2">Start Time</th>
                  <th class="px-4 py-2">Actual Start Time</th>
                  <th class="px-4 py-2">End Time</th>
                  <th class="px-4 py-2">Actual End Time</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        @endforeach

        <form method="POST" action="{{ route('shifts.store') }}"
          class="mx-auto max-w-md rounded-lg bg-white p-6 shadow-md">
          @csrf
          <div class="mb-4">
            <label for="user_id"
              class="mb-2 block font-bold text-gray-700">User:</label>
            <div class="relative">
              <select name="user_id" id="user_id"
                class="form-select block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 pr-8 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none">
                @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}
                  </option>
                @endforeach
              </select>
              <div
                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="h-4 w-4 fill-current"
                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                  <path fill-rule="evenodd"
                    d="M20 10a10 10 0 11-20 0 10 10 0 0120 0zm-2 0a8 8 0 11-16 0 8 8 0 0116 0z"
                    clip-rule="evenodd" />
                </svg>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <label for="planned_start_time"
              class="mb-2 block font-bold text-gray-700">Start Time:</label>
            <input type="datetime-local" id="planned_start_time"
              name="planned_start_time"
              class="form-input block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 pr-8 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
              value="{{ $date }}T00:00:00">
          </div>
          <div class="mb-4">
            <label for="planned_end_time"
              class="mb-2 block font-bold text-gray-700">End Time:</label>
            <input type="datetime-local" id="planned_end_time"
              name="planned_end_time"
              class="form-input block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 pr-8 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
              value="{{ $date }}T00:00:00">
          </div>
          <div class="mb-4 flex justify-center">
            <button type="submit"
              class="rounded bg-blue-500 px-6 py-3 font-bold text-white hover:bg-blue-700">Add
              Shift</button>
          </div>
        </form>

</x-app-layout>

<!--

    This had potential, might be useful later

                @foreach ($employees as $employee)
@if (count($shifts) > 0)
@php
  $shifts = $employee
      ->shifts()
      ->whereDate('planned_start_time', '=', $date)
      ->get();
@endphp
                    <div class="grid grid-cols-1 justify-center gap-4">
                        <div class="rounded border p-4">
                            <table class="w-full table-auto">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">Employee Name</th>
                                        <th class="px-4 py-2">Start Time</th>
                                        <th class="px-4 py-2">Actual Start Time</th>
                                        <th class="px-4 py-2">End Time</th>
                                        <th class="px-4 py-2">Actual End Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($shifts as $shift)
<tr>
                                                <td class="border px-4 py-2 text-center">{{ $employee->user->name }}</td>
                                                <td class="border px-4 py-2 text-center">{{ \Carbon\Carbon::parse($shift->planned_start_time)->format('H:i:s') }}</td>
                                                <td class="border px-4 py-2 text-center">{{ $shift->actual_start_time ? \Carbon\Carbon::parse($shift->actual_start_time)->format('H:i:s') : '-' }}</td>
                                                <td class="border px-4 py-2 text-center">{{ \Carbon\Carbon::parse($shift->planned_end_time)->format('H:i:s') }}</td>
                                                <td class="border px-4 py-2 text-center">{{ $shift->actual_end_time ? \Carbon\Carbon::parse($shift->actual_end_time)->format('H:i:s') : '-' }}</td>
                                                <td class="border px-4 py-2 text-center">
                                                    <form method="POST" action="{{ route('shifts.destroy', $shift->id) }}" onSubmit="return confirm('Are you sure you want to delete this shift?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
@endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
@endif
@endforeach
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('shifts.store') }}" class="mx-auto max-w-md rounded-lg bg-white p-6 shadow-md">
        @csrf
        <div class="mb-4">
            <label for="user_id" class="mb-2 block font-bold text-gray-700">User:</label>
            <div class="relative">
                <select name="user_id" id="user_id" class="form-select block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 pr-8 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none">
                    @foreach ($users as $user)
<option value="{{ $user->id }}">{{ $user->name }}</option>
@endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M20 10a10 10 0 11-20 0 10 10 0 0120 0zm-2 0a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="mb-4">
        <label for="planned_start_time" class="mb-2 block font-bold text-gray-700">Start Time:</label>
        <input type="datetime-local" id="planned_start_time" name="planned_start_time" class="form-input block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 pr-8 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none" value="{{ $date }}T00:00:00">
    </div>
    <div class="mb-4">
        <label for="planned_end_time" class="mb-2 block font-bold text-gray-700">End Time:</label>
        <input type="datetime-local" id="planned_end_time" name="planned_end_time" class="form-input block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 pr-8 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none" value="{{ $date }}T00:00:00">
    </div>
    <div class="mb-4 flex justify-center">
        <button type="submit" class="rounded bg-blue-500 px-6 py-3 font-bold text-white hover:bg-blue-700">Add Shift</button>
    </div>
    </form>

-->
