{{-- -*-html-*- --}}

@if (!empty($url))
  <a href="{{ $url }}"
    class="mx-4 my-4 h-40 w-60 overflow-hidden rounded-lg bg-blue-100 transition-colors duration-200 ease-in-out hover:bg-blue-200">
@endif
<div
  class="flex h-full w-full flex-shrink flex-grow flex-col items-center justify-center p-2">
  @if (!empty($icon))
    <div class="mb-2">
      <svg class="h-8 w-8 text-gray-500" fill="none" stroke="currentColor"
        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 6l9-4 9 4v8a4 4 0 01-4 4H7a4 4 0 01-4-4V6z"></path>
      </svg>
    </div>
  @endif
  <h2 class="mb-2 text-center text-lg font-bold text-gray-950">
    {{ $title }}</h2>
  <h3 class="mb-2 text-center text-sm font-medium text-gray-600">
    {{ $description }}</h3>
</div>
@if (!empty($url))
  </a>
@endif
