<x-app-layout>
  <div div class="mx-auto max-w-screen-md px-4 py-8 lg:py-16">

    <h1
      class="mb-4 text-center text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
      Ticket submitted successfully
    </h1>

    <p
      class="mb-8 text-center font-light text-gray-500 dark:text-gray-400 sm:text-xl">
      Thank you for submitting your ticket! We will try and resolve it as
      quickly as possible.
    </p>

    <ul class="mx-auto flex flex-col items-center">
      <li
        class="mb-1 block text-center font-light text-gray-500 dark:text-gray-400 sm:text-xl">
        <strong>Issue</strong>
      </li>
      <li
        class="mb-6 block w-3/5 rounded-lg border border-primary-500 bg-gray-50 p-2.5 text-center text-base font-medium text-gray-900 ring-primary-500 dark:border-white dark:bg-gray-700 dark:text-white dark:ring-primary-500">
        {{ $ticket->issue }}
      </li>
      <li
        class="mb-1 block text-center font-light text-gray-500 dark:text-gray-400 sm:text-xl">
        <strong>Description</strong>
      </li>
      <li
        class="mb-6 block w-3/5 rounded-lg border border-primary-500 bg-gray-50 p-2.5 text-center text-base font-medium text-gray-900 ring-primary-500 dark:border-white dark:bg-gray-700 dark:text-white dark:ring-primary-500">
        {{ $ticket->description }}
      </li>
    </ul>

  </div>
</x-app-layout>
