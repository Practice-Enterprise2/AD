<x-app-layout>
  <div class="flex items-center justify-center">
    <div
      class="mx-auto grid grid-cols-4 items-center justify-center gap-8 md:grid-cols-4"
      style="height: 80vh; width: 80vw;">
      <x-canvas-tile title="Dashboard" :url="route('dashboard')"
        description="To the dashboard"></x-canvas-tile>
      @can('view_general_employee_content')
        <x-canvas-tile title="Employee" :url="route('employee')"
          description="Explore and search for employees in the company"></x-canvas-tile>
      @endcan
      <x-canvas-tile :url="route('shipments.create')" title="Shipment Requests"
        description="Request new shipments and track their progress"></x-canvas-tile>
      @canany(['view_basic_server_info', 'view_all_users', 'view_all_roles',
        'view_detailed_server_info', 'edit_roles'])
        <x-canvas-tile :url="route('control-panel')" title="Control Panel"
          description="Manage user roles and access to company resources"></x-canvas-tile>
      @endrole
      @can('view_employee_count')
        <x-canvas-tile :url="route('employeegraph')" title="Employee Graph"
          description=" Visualize the company's employee count over time"></x-canvas-tile>
      @endcan
      @can('edit_all_shipments')
        <x-canvas-tile title="Evaluate Shipment Requests"
          description="Evaluate incoming shipment requests"
          :url="route('shipments.requests')"></x-canvas-tile>
      @endcan
      <x-canvas-tile :url="route('shipments.index')" title="Confirmed Shipments"
        description="show confirmed shipments"></x-canvas-tile>
      @can('view_reviews')
        <x-canvas-tile :url="route('readreviews')" title="Customer Complaints"
          description="Stay informed about all customer complaints and reviews"></x-canvas-tile>
      @endcan
      @can('view_all_complaints')
        <x-canvas-tile :url="route('contact.index')" title="Problems"
          description="Respond to questions that the users have"></x-canvas-tile>
      @endcan
      @can('add_edit_vacant_jobs')
        <x-canvas-tile :url="route('employeegraph')" title="Employee Graph"
          description=" Visualize the company's employee count over time"></x-canvas-tile>
      @endcan
      <x-canvas-tile :url="route('contact.create')" title="Contact Us"
        description="Get in touch with us"></x-canvas-tile>
      <x-canvas-tile :url="route('complaints.messages')" title="Messages"
        description="Stay connected with us"></x-canvas-tile>
      <x-canvas-tile :url="route('faq.show')" title="FAQ"
        description="Quick answers to common questions"></x-canvas-tile>
      @if (Route::has('login'))
        <x-canvas-tile :url="route('profile.edit')" title="Profile"
          description="Preview your public profile and make changes as needed"></x-canvas-tile>
      @endif
    </div>
  </div>
</x-app-layout>
