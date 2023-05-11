@if(!empty($url))
  <a href="{{ $url }}" class="bg-blue-100 w-60 h-40 mx-4 my-4 rounded-lg overflow-hidden hover:bg-blue-200 transition-colors duration-200 ease-in-out">
@endif
<div class="w-full h-full p-2 flex flex-col justify-center items-center flex-grow flex-shrink">
@if(!empty($icon))
    <div class="mb-2">
      <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l9-4 9 4v8a4 4 0 01-4 4H7a4 4 0 01-4-4V6z"></path>
      </svg>
    </div>
@endif
  <h2 class="text-lg font-bold mb-2 text-center">{{ $title }}</h2>
  <h3 class="text-sm font-medium text-gray-600 mb-2 text-center">{{ $description }}</h3>
</div>
@if (!empty($url))
  </a>
@endif
