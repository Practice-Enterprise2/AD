<x-app-layout>

  <div class="mx-auto">
    <h1 class="m-8 text-center text-3xl">Invoices List</h1>
    @if (\Session::has('success'))
      <div class="alert alert-success text-center text-green-400">
        <ul>
          <li class="text-green-400">{!! \Session::get('success') !!}</li>
        </ul>
      </div>
    @endif
    @livewire('invoice-list')
  </div>

</x-app-layout>
