<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="font-bold text-2xl mb-4 m-3">Shifts for {{ $date }}</h2>

                <div class="grid grid-cols-1 gap-4 justify-center">
                    @foreach($employees as $employee)
                        @php
                            $shifts = $employee->shifts()->whereDate('planned_start_time', '=', $date)->get();
                        @endphp
                        @if(count($shifts) > 0)
                            <div class="border p-4 rounded">
                                <table class="table-auto w-full">
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
                                        @foreach($shifts as $shift)
                                            <tr>
                                                <td class="border px-4 py-2 text-center">{{ $employee->user->name }}</td>
                                                <td class="border px-4 py-2 text-center">{{ \Carbon\Carbon::parse($shift->planned_start_time)->format('H:i:s') }}</td>
                                                <td class="border px-4 py-2 text-center">{{ $shift->actual_start_time ? \Carbon\Carbon::parse($shift->actual_start_time)->format('H:i:s') : '-' }}</td>
                                                <td class="border px-4 py-2 text-center">{{ \Carbon\Carbon::parse($shift->planned_end_time)->format('H:i:s') }}</td>
                                                <td class="border px-4 py-2 text-center">{{ $shift->actual_end_time ? \Carbon\Carbon::parse($shift->actual_end_time)->format('H:i:s') : '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>