{{-- -*-html-*- --}}

<x-app-layout>
  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div
        class="column overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          {{ __('Order placed! You will receive an invoice in your mail box.') }}
        </div>
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <p>Did you not receive your mail? Click the button below!</p>
          <button
            class="rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"
            type="submit"
            onclick="@php echo 'location.reload();' @endphp">Resend</button>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
