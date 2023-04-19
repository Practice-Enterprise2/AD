<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="font-bold text-2xl mb-4 m-3">Shifts for {{ $date }}</h2>

                <div class="grid grid-cols-2 gap-4">
                    @foreach($employees as $employee)
                        <div>
                            <h3 class="font-bold text-lg mb-2">{{ $employee->name }}</h3>
                            @foreach($shifts as $shift)
                                @if($shift->employee_id == $employee->id)
                                    <div class="border rounded p-2 mb-2">
                                        {{ $shift->planned_start_time }} - {{ $shift->planned_end_time }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>