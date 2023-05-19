{{-- -*-html-*- --}}

<x-app-layout>

  <section class="bg-white dark:bg-gray-900">
    <div class="mx-auto max-w-screen-md px-4 py-8 lg:py-16">
      <h2
        class="mb-4 text-center text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
        Contact Us</h2>
      <p
        class="mb-8 text-center font-light text-gray-500 dark:text-gray-400 sm:text-xl lg:mb-16">
        Got a technical issue? Want to send feedback about a beta feature? Need
        details about our Business plan? Let us know.</p>
      <form method="post" action="{{ route('contact.store') }}" class="space-y-8">
        @csrf
        <div>
          <label for="email"
            class="mb-2 block text-sm font-medium text-gray-900 dark:text-gray-300">Your
            email</label>
          <input type="email" id="email" name="email"
            class="dark:shadow-sm-light block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
            placeholder="name@flowbite.com" required>
        </div>
        <div>
          <label for="shipment_id"
            class="mb-2 block text-sm font-medium text-gray-900 dark:text-gray-300">Shipment
            ID</label>
          <input type="number" id="shipment_id" name="shipment_id"
            class="dark:shadow-sm-light block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
            placeholder="0000">
        </div>
        <div>
          <label for="subject"
            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select
            an option</label>
          <select id="subject" name="subject"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
            <option selected>Choose the problem that you have</option>
            <option value="package-location">Where is my package</option>
            <option value="request-cancel">I want to cancel the shipment
            </option>
            <option value="received-no-package">I haven't receive packages
            </option>
            <option value="other">Other reason</option>
          </select>
        </div>
        <div class="sm:col-span-2">
          <label for="message"
            class="mb-2 block text-sm font-medium text-gray-900 dark:text-gray-400">Your
            message</label>
          <textarea id="message" name="message" rows="6"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
            placeholder="Leave a comment..."></textarea>
        </div>
        <button type="submit"
          class="rounded-lg bg-primary-700 px-5 py-3 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:w-fit">Send
          message</button>
      </form>
    </div>
  </section>
</x-app-layout>
