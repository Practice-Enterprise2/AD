{{-- -*-html-*- --}}

<x-public-layout>
  <div class="mx-auto flex flex-col gap-8 sm:container sm:py-16">
    <div class="flex h-[400px] justify-between gap-8 bg-gray-100 sm:rounded-lg">
      <div class="flex flex-col items-start gap-8 px-4 py-16 sm:px-16">
        <div>
          <h1 class="text-2xl font-bold text-gray-700">Welcome to BlueSky</h1>
          <h2 class="text-lg text-gray-500">We Ship Your Package, Anywhere,
            Anytime</h2>
        </div>
        <a href="{{ route('register') }}"
          class="rounded bg-blue-500 p-2 font-bold text-white">Sign Up</a>
      </div>
      <img
        src="https://cdn.pixabay.com/photo/2016/08/18/00/08/belgium-1601917_960_720.jpg"
        class="fade-to-l hidden rounded-r-lg bg-gradient-to-l from-current object-contain lg:block"></img>
    </div>
    <div class="flex h-[400px] justify-between gap-8 bg-gray-100 sm:rounded-lg">
      <img
        src="https://cdn.pixabay.com/photo/2018/09/24/15/04/board-3700116_960_720.jpg"
        class="fade-to-r hidden rounded-l-lg object-fill lg:block"></img>
      <div class="flex flex-col items-start gap-8 px-4 py-16 sm:px-16">
        <div>
          <h1 class="text-2xl font-bold text-gray-700">Read Our Customer Stories
          </h1>
          <h2 class="text-lg text-gray-500">Know Why People Choose to Ship With
            BlueSky</h2>
        </div>
        <a href="{{ route('reviews.index') }}"
          class="rounded bg-blue-500 p-2 font-bold text-white">Reviews</a>
      </div>
    </div>
    <div class="flex h-[400px] justify-between gap-8 bg-gray-100 sm:rounded-lg">
      <div class="flex flex-col items-start gap-8 px-4 py-16 sm:px-16">
        <div>
          <h1 class="text-2xl font-bold text-gray-700">Want to work at BlueSky
          </h1>
          <h2 class="text-lg text-gray-500">Come and join our dynamic team</h2>
        </div>
        <a href="{{ route('view_jobs') }}"
          class="rounded bg-blue-500 p-2 font-bold text-white">Jobs</a>
      </div>
      <img
        src="https://www.breathehr.com/hubfs/Group%20of%20creative%20business%20people-min%20%281%29.webp"
        class="fade-to-l hidden rounded-r-lg bg-gradient-to-l from-current object-contain lg:block"></img>
    </div>
  </div>
</x-public-layout>
{{-- vim: ft=html
--}}
