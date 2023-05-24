<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Shifts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($shifts->isEmpty())
                        <p>{{ __('No shifts found.') }}</p>
                    @else
                        <div class="overflow-x-auto">
                            @php
                                $todayShift = $shifts->first(function ($shift) {
                                    return Carbon\Carbon::parse($shift->planned_start_time)->setTimezone('Europe/Brussels')->isToday();
                                });

                                $futureShifts = $shifts->filter(function ($shift) {
                                    return Carbon\Carbon::parse($shift->planned_start_time)->setTimezone('Europe/Brussels')->isFuture();
                                });

                                $pastShifts = $shifts->filter(function ($shift) {
                                    return Carbon\Carbon::parse($shift->planned_start_time)->setTimezone('Europe/Brussels')->isPast();
                                });
                            @endphp

                            @if ($todayShift)
                                <h4 class="font-semibold text-lg mb-4">{{ __('Today\'s Shift') }}</h4>
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Date') }}
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Start Time') }}
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('End Time') }}
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Actual Start Time') }}
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Actual End Time') }}
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Actions') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ Carbon\Carbon::parse($todayShift->planned_start_time)->setTimezone('Europe/Brussels')->toDateString() }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ Carbon\Carbon::parse($todayShift->planned_start_time)->setTimezone('Europe/Brussels')->toTimeString() }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ Carbon\Carbon::parse($todayShift->planned_end_time)->setTimezone('Europe/Brussels')->toTimeString() }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($todayShift->actual_start_time)
                                                    {{ Carbon\Carbon::parse($todayShift->actual_start_time)->setTimezone('Europe/Brussels')->toDateTimeString() }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($todayShift->actual_end_time)
                                                    {{ Carbon\Carbon::parse($todayShift->actual_end_time)->setTimezone('Europe/Brussels')->toDateTimeString() }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($todayShift->actual_start_time && $todayShift->actual_end_time)
                                                    Shift completed
                                                @elseif ($todayShift->actual_start_time)
                                                    <form method="POST" action="{{ route('shifts.stop', $todayShift->id) }}">
                                                        @csrf
                                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                            Stop Shift
                                                        </button>
                                                    </form>
                                                @else
                                                    <form method="POST" action="{{ route('shifts.start', $todayShift->id) }}">
                                                        @csrf
                                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                                            Start Shift
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif

                            @if ($futureShifts->isNotEmpty())
    <h4 class="font-semibold text-lg mb-4">{{ __('Future Shifts') }}</h4>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ __('Date') }}
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ __('Start Time') }}
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ __('End Time') }}
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ __('Actions') }}
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($futureShifts as $shift)
                @if (!$todayShift || $shift->id !== $todayShift->id)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ Carbon\Carbon::parse($shift->planned_start_time)->setTimezone('Europe/Brussels')->toDateString() }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ Carbon\Carbon::parse($shift->planned_start_time)->setTimezone('Europe/Brussels')->toTimeString() }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ Carbon\Carbon::parse($shift->planned_end_time)->setTimezone('Europe/Brussels')->toTimeString() }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Shift not started
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endif

                            @if ($pastShifts->isNotEmpty())
                                <h4 class="font-semibold text-lg mb-4">{{ __('Past Shifts') }}</h4>
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Date') }}
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Start Time') }}
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('End Time') }}
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Actual Start Time') }}
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Actual End Time') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($pastShifts as $shift)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ Carbon\Carbon::parse($shift->planned_start_time)->setTimezone('Europe/Brussels')->toDateString() }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ Carbon\Carbon::parse($shift->planned_start_time)->setTimezone('Europe/Brussels')->toTimeString() }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ Carbon\Carbon::parse($shift->planned_end_time)->setTimezone('Europe/Brussels')->toTimeString() }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if ($shift->actual_start_time)
                                                        {{ Carbon\Carbon::parse($shift->actual_start_time)->setTimezone('Europe/Brussels')->toDateTimeString() }}
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if ($shift->actual_end_time)
                                                        {{ Carbon\Carbon::parse($shift->actual_end_time)->setTimezone('Europe/Brussels')->toDateTimeString() }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>