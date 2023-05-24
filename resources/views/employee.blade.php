{{-- -*-html-*- --}}

<x-app-layout>
  <x-content-layout>
    <div class="mx-auto flex flex-wrap justify-center gap-8">
      @canany(['add_vacant_jobs', 'edit_vacant_jobs'])
        <x-canvas-tile :url="route('hr_view_jobs')" title="HR Vacant Jobs"
          description="Add and edit job vacancies"></x-canvas-tile>
      @endrole
      @can('view_general_employee_content')
        <x-canvas-tile :url="route('employee_complaints')" title="Complaint"
          description="Submit a complaint about an event on the workfloor"></x-canvas-tile>
      @endcan
    </div>
  </x-content-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
