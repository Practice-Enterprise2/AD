<x-app-layout>
    @can('view_general_employee_content')
        <x-canvas-tile :url="route('employee_complaints')" title="Complaint"
            description="Submit a complaint about an event on the workfloor"></x-canvas-tile>
    @endcan
</x-app-layout>
{{-- vim: ft=html
--}}
