{{-- -*-html-*- --}}

<x-app-layout>
  <div
    class="flex w-screen flex-col items-center justify-start text-gray-900 dark:text-gray-100">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
      {{ __('Customer\'s contact Page') }}
    </h2>
    @foreach ($contacts as $contact)
      <div
        class="my-8 flex w-10/12 flex-col items-center rounded bg-slate-800 px-8 py-10">
        <h2 class="-mt-8 text-lg font-medium text-gray-900 dark:text-gray-100">
          @if ($contact->subject == 'request-cancel')
            {{ __('Request cancel shipment') }}
          @elseif($contact->subject == 'package-location')
            {{ __('Where is my package') }}
          @elseif($contact->subject == 'received-no-package')
            {{ __('I haven\'t receive my packages') }}
          @else
            {{ __('Other problem') }}
          @endif
        </h2>
        <div class="w-full">
          <div class="w-8/12">
            <h2>Email: {{ $contact->email }}</h2>
            <h2>Shipment ID: {{ $contact->shipment_id }}</h2>
            <a href="{{ route('contact.show', $contact->id) }}"
              class="text-blue-200">Detail...</a>
            <form action="{{ route('contact.destroy', $contact->id) }}"
              method="POST">
              @csrf
              @method('DELETE')
              <div class="flex items-center gap-4">
                <button
                  class="my-2 rounded bg-red-500 px-3 py-2">{{ __('Delete') }}</button>
              </div>

            </form>
            <form action="{{ route('chatbox.create', $contact->id) }}"
              method="POST">
              @csrf
              <button
                class="my-2 rounded bg-yellow-500 px-3 py-2">{{ __('Handle complaint') }}</button>

            </form>
          </div>
        </div>
      </div>
    @endforeach

</x-app-layout>
