{{-- -*-html-*- --}}

<x-app-layout>
  <div
    class="flex w-screen flex-col items-center justify-center text-gray-900 dark:text-gray-100">
    <h2 class="py-5 text-lg font-medium text-gray-900 dark:text-gray-100">
      {{ __('Contact Detail') }}
    </h2>
    <h2 class="py-5 text-lg font-medium text-gray-900 dark:text-gray-100">
      Shipment ID:
      @if ($contact->shipment_id == 0)
        None
      @else
        {{ $contact->shipment_id }}
      @endif
    </h2>
    <div class="flex w-8/12 flex-col items-start justify-center">
      <h2>Email: {{ $contact->email }}</h2>
      <h2>Problem: {{ $contact->subject }}</h2>
      <h2>Detail: {{ $contact->message }}</h2>
      <form action="{{ route('contact.destroy', $contact->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="flex items-center gap-4">
          <button
            class="my-2 rounded bg-red-500 px-3 py-2">{{ __('Delete') }}</button>
        </div>

      </form>
      @if ($contact->is_handled == 0)
        <form action="{{ route('chatbox.create', $contact->id) }}" method="POST">
          @csrf
          <button
            class="my-2 rounded bg-yellow-500 px-3 py-2">{{ __('Handle complaint') }}</button>
      @endif
      </form>
    </div>

  </div>
</x-app-layout>
