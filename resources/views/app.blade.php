<x-app-layout>
  <div class="mx-auto grid grid-cols-4 md:grid-cols-4 gap-80 justify-center" style="height: 400px; width: 800px;">
    @auth
      <x-canvas-tile title="dashboard" url="/dashboard" description="To the dashboard"></x-canvas-tile>
    @endauth
    @can('view_general_employee_content')
      <x-canvas-tile title="Employee" url="/employee" description="See al the employees in the company"></x-canvas-tile>
    @endcan
    @auth
      <x-canvas-tile url="/readreviews" title="Read Reviews" description="See all the complaint made by the customers"></x-canvas-tile>
    @endauth
    @auth
    <x-canvas-tile url="/shipments/requests" title="Request a shipment" description="here you can create a new shipment"></x-canvas-tile>
    @endauth
  </div>
</x-app-layout>
