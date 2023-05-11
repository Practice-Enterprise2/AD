<x-app-layout>
<div class="flex items-center justify-center">
    <div class="mx-auto grid grid-cols-4 md:grid-cols-4 gap-8 justify-center items-center" style="height: 80vh; width: 80vw;">
    @auth
      <x-canvas-tile title="Dashboard" url="/dashboard" description="To the dashboard" ></x-canvas-tile>
    @endauth
    @can('view_general_employee_content')
      <x-canvas-tile title="Employee" url="/employee" description="Explore and search for employees in the company"></x-canvas-tile>
    @endcan
    @can('view_reviews')
      <x-canvas-tile url="/readreviews" title="Customer Complaints" description="Stay informed about all customer complaints and reviews"></x-canvas-tile>
    @endcan
    @auth
    <x-canvas-tile url="/shipments/requests" title="Shipment Requests" description="Request new shipments and track their progress"></x-canvas-tile>
    @endauth
    @canany(['view_basic_server_info', 'view_all_users', 'view_all_roles',
            'view_detailed_server_info', 'edit_roles'])
    <x-canvas-tile url="/control-panel" title="Control Panel" description="Manage user roles and access to company resources"></x-canvas-tile>
    @endrole
    @if (Route::has('login'))
      <x-canvas-tile url="/profile" title="Profile" description="Preview your public profile and make changes as needed"></x-canvas-tile>
    @endif
    @can('view_employee_count')
      <x-canvas-tile url="/employeegraph" title="Employee Graph" description=" Visualize the company's employee count over time"></x-canvas-tile>
    @endcan
    @auth 
     <x-canvas-tile url="/faq" title="FAQ" description="Quick answers to common questions"></x-canvas-tile>
    @endauth
    @auth 
     <x-canvas-tile url="/contact" title="Contact" description="Get in touch with us"></x-canvas-tile>
    @endauth
    @auth 
     <x-canvas-tile url="/messages" title="Messages" description="Stay connected with us"></x-canvas-tile>
    @endauth
    
  </div>
</div>
</x-app-layout>
