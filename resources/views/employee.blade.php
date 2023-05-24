{{-- -*-html-*- --}}

<x-app-layout>
  <div class="flex items-center justify-center">
    <div
      class="mx-auto grid grid-cols-4 items-center justify-center gap-8 md:grid-cols-4"
      style="height: 80vh; width: 80vw;">
      @canany(['add_vacant_jobs', 'edit_vacant_jobs'])
        <x-canvas-tile :url="route('hr_view_jobs')" title="HR Vacant Jobs"
          description="Add and edit job vacancies"></x-canvas-tile>
      @endrole
      @can('view_general_employee_content')
        <x-canvas-tile :url="route('employee_complaints')" title="Complaint"
          description="Submit a complaint about an event on the workfloor"></x-canvas-tile>
      @endcan
    </div>
  </div>
</x-app-layout>
{{-- vim: ft=html
--}}
