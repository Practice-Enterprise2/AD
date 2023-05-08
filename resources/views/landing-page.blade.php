<x-public-layout>
  <div class="mx-auto sm:container sm:py-16">
    <div class="flex justify-between gap-8 bg-gray-100 sm:rounded-lg">
      <div class="flex flex-col items-start gap-8 px-4 py-24 sm:px-16">
        <div>
          <h1 class="text-xl font-bold text-gray-700">Welcome to BlueSky</h1>
          <h2 class="text-lg text-gray-500">We Ship Your Package, Anywhere,
            Anytime</h2>
        </div>
        <a href="{{ route('register') }}"
          class="rounded bg-blue-500 p-2 text-white">Sign Up</a>
      </div>
      <image
        src="https://cdn.pixabay.com/photo/2016/08/18/00/08/belgium-1601917_960_720.jpg"
        class="hidden h-[400px] w-[400px] rounded-r-lg md:block"></image>
    </div>
  </div>
</x-public-layout>
{{-- vim: ft=html
--}}
