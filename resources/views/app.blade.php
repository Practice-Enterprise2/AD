<x-app-layout>
<div class="flex items-center justify-center">
    <div class="mx-auto grid grid-cols-4 md:grid-cols-4 gap-8 justify-center items-center" style="height: 80vh; width: 80vw;">
    @auth
      <x-canvas-tile title="dashboard" url="/dashboard" description="To the dashboard" icon="<svg xmlns='http://www.w3.org/2000/svg' class='h-8 w-8 text-gray-500' viewBox='0 0 20 20' fill='currentColor'><path fill-rule='evenodd' d='M2 9h8v8H2V9zm10-7h8v15h-8V2zM4 13h4v4H4v-4z' clip-rule='evenodd' /></svg>" ></x-canvas-tile>
    @endauth
    @can('view_general_employee_content')
      <x-canvas-tile title="Employee" url="/employee" description="Explore and search for employees in the company"></x-canvas-tile>
    @endcan
    @auth
      <x-canvas-tile url="/readreviews" title="Customer Complaints" description="Stay informed about all customer complaints and reviews"></x-canvas-tile>
    @endauth
    @auth
    <x-canvas-tile url="/shipments/requests" title="Shipment Requests" description="Request new shipments and track their progress"></x-canvas-tile>
    @endauth
    @canany(['view_basic_server_info', 'view_all_users', 'view_all_roles',
            'view_detailed_server_info', 'edit_roles'])
    <x-canvas-tile url="/control-panel" title="Control Panel" description="Manage user roles and access to company resources"></x-canvas-tile>
    @endrole
    @if (Route::has('login'))
      <x-canvas-tile url="/profile" title="Profile" description="Preview your public profile and make changes as needed" icon="<svg xmlns='http://www.w3.org/2000/svg' class='h-8 w-8 text-gray-500' viewBox='0 0 20 20' fill='currentColor'><path fill-rule='evenodd' d='M10 1c-4.411 0-8 3.589-8 8s3.589 8 8 8 8-3.589 8-8-3.589-8-8-8zm0 2.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zm0 11c-3.038 0-5.5-2.462-5.5-5.5 0-.971.259-1.878.711-2.664C7.264 5.581 8.59 5 10 5c1.41 0 2.736.581 3.789 1.836.452.786.711 1.693.711 2.664 0 3.038-2.462 5.5-5.5 5.5z' clip-rule='evenodd'/></svg>"></x-canvas-tile>
    @endif
    @can('view_employee_count')
      <x-canvas-tile url="/employeegraph" title="Employee Graph" description=" Visualize the company's employee count over time"></x-canvas-tile>
    @endcan
  </div>
</div>
</x-app-layout>
