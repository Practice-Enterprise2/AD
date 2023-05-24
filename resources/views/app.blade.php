{{-- -*-html-*- --}}

<x-app-layout>
  <x-content-layout>
    <div class="mx-auto flex flex-wrap justify-center gap-8">
      @can('view_general_employee_content')
        <x-canvas-tile title="Employee" :url="route('employees.index')"
          description="Explore and search for employees in the company"></x-canvas-tile>
      @endcan
      <x-canvas-tile :url="route('shipments.create')" title="Shipment Requests"
        description="Request new shipments and track their progress"></x-canvas-tile>
      <x-canvas-tile :url="route('shipments.listShipments')" title="My Shipments"
        description="Shows list of your shipments"></x-canvas-tile>
      <x-canvas-tile :url="route('pickups.create')" title="Order Package Pickup"
        description="Get your package from your doorstep to your recipient"></x-canvas-tile>
      @canany(['view_basic_server_info', 'view_all_users', 'view_all_roles',
        'view_detailed_server_info', 'edit_roles'])
        <x-canvas-tile :url="route('control-panel')" title="Control Panel"
          description="Manage user roles and access to company resources"></x-canvas-tile>
      @endrole
      @can('view_employee_count')
        <x-canvas-tile title="Employee Graph" :url="route('employeegraph')"
          description=" Visualize the company's employee count over time"></x-canvas-tile>
      @endcan
      @can('view_all_orders')
        <x-canvas-tile :url="route('ai-graph')" title="AI Order Graph"
          description="View the AI order graph"></x-canvas-tile>
      @endcan
      @can('edit_all_shipments')
        <x-canvas-tile title="Evaluate Shipment Requests"
          description="Evaluate incoming shipment requests"
          :url="route('shipments.requests')"></x-canvas-tile>
      @endcan
      <x-canvas-tile :url="route('shipments.index')" title="Confirmed Shipments"
        description="show confirmed shipments"></x-canvas-tile>
      <x-canvas-tile :url="route('pickups.index')" title="Pickups"
        description="See all your package pickups"></x-canvas-tile>
      @can('view_reviews')
        <x-canvas-tile :url="route('reviews.index')" title="Customer Complaints"
          description="Stay informed about all customer complaints and reviews"></x-canvas-tile>
      @endcan
      @can('view_all_complaints')
        <x-canvas-tile :url="route('contact.index')" title="Problems"
          description="Respond to questions that the users have"></x-canvas-tile>
      @endcan

      <x-canvas-tile :url="route('contact.create')" title="Contact Us"
        description="Get in touch with us"></x-canvas-tile>
      <x-canvas-tile :url="route('complaints.messages')" title="Messages"
        description="Stay connected with us"></x-canvas-tile>
      <x-canvas-tile :url="route('help')" title="Help"
        description="Get help with common questions"></x-canvas-tile>
      @if (Route::has('login'))
        <x-canvas-tile :url="route('profile.edit')" title="Profile"
          description="Preview your public profile and make changes as needed"></x-canvas-tile>
      @endif
      <x-canvas-tile :url="route('reviews.create')" title="Review Us"
        description="If you want to share your experience, you can leave a review"></x-canvas-tile>
      <x-canvas-tile :url="route('invoice_overview')" title="Invoices"
        description="View your invoices here"></x-canvas-tile>
    </div>
  </x-content-layout>
</x-app-layout>
