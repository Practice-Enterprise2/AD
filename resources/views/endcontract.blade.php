<x-app-layout>
  <div class="container mx-auto px-4 py-6">
    <div class="overflow-x-auto">
      <div
        class="inline-block min-w-full overflow-hidden border-b border-gray-200 align-middle shadow sm:rounded-lg">
        <table class="min-w-full">
          <thead>
            <tr class="border-b border-gray-200">
              <th
                class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                id</th>
              <th
                class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                firstname</th>
              <th
                class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                lastname</th>
              <th
                class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                Start Date</th>
              <th
                class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                End Date</th>
              <th
                class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                Action</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach ($employeesWithUsers as $employee)
              <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="whitespace-no-wrap px-6 py-4">{{ $employee->id }}
                </td>
                @if ($employee->user)
                  <td class="whitespace-no-wrap px-6 py-4">
                    {{ $employee->user->name }}</td>
                  <td class="whitespace-no-wrap px-6 py-4">
                    {{ $employee->user->last_name }}</td>
                @else
                  <td class="whitespace-no-wrap px-6 py-4">N/A</td>
                  <td class="whitespace-no-wrap px-6 py-4">N/A</td>
                @endif
                </td>
                <td class="whitespace-no-wrap px-6 py-4">
                  @foreach ($employee->employee_contracts as $contract)
                    {{ $contract->start_date }}
                  @endforeach
                </td>
                <td class="whitespace-no-wrap px-6 py-4">
                  @foreach ($employee->employee_contracts as $contract)
                    {{ $contract->end_date }}
                  @endforeach
                </td>
                <td class="whitespace-nowrap px-6 py-4">
                  <div class="flex space-x-4">
                    <form method="POST"
                      action="{{ route('contracts.renew', $employee->id) }}">
                      @csrf
                      <button type="submit"
                        class="rounded bg-green-500 px-4 py-2 font-bold text-white hover:bg-green-700">
                        Renew Contract
                      </button>
                    </form>
                    <form method="POST"
                      action="{{ route('contracts.determine', $employee->id) }}">
                      @csrf
                      <button type="submit"
                        class="rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700">
                        Determine Contract
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>
