<x-app-layout>
<div>

    <form method="POST" action="{{ route('submitted-ticket') }}" class="text-stone-50">
        @csrf
        <label for="cstID" >Cst ID</label>
        <input type="text" name="cstID" id="cstID" class="text-neutral-950" value="{{ old('CstID') }}" required>

        <label for="issue">Issue</label>
        <input type="text" name="issue" id="issue" class="text-neutral-950" value="{{ old('Issue') }}" required>
        
        <label for="description">Description</label>
        <textarea name="description" id="description" class="text-neutral-950" required>{{ old('description') }}</textarea>

        <button type="submit">Submit</button>
    </form>
    
</div>
</x-app-layout>

{{-- <x-app-layout>

    <section class="bg-white dark:bg-gray-900">
      <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Contact Us</h2>
          <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Got a technical issue? Want to send feedback about a beta feature? Need details about our Business plan? Let us know.</p>
          <form method="post" action="{{ route('contact.store' )}}" class="space-y-8">
            @csrf
              <div>
                  <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
                  <input type="email" id="email" name="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="name@flowbite.com" required>
              </div>
              <div>
                  <label for="shipment_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Shipment ID</label>
                  <input type="number" id="shipment_id" name="shipment_id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="0000">
              </div>
              <div>
                <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                <select id="subject" name="subject" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Choose the problem that you have</option>
                <option value="package-location">Where is my package</option>
                <option value="request-cancel">I want to cancel the shipment</option>
                <option value="received-no-package">I haven't receive packages</option>
                <option value="other">Other reason</option>
                </select>
              </div>
              <div class="sm:col-span-2">
                  <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Your message</label>
                  <textarea id="message" name="message" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Leave a comment..."></textarea>
              </div>
              <button type="submit" class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-primary-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Send message</button>
          </form>
      </div>
    </section>
    </x-app-layout> --}}