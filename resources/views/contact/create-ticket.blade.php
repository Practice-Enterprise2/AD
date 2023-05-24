<x-public-layout>
  <div class="mx-auto max-w-screen-md px-4 py-8 lg:py-16">

    <h2
      class="mb-4 text-center text-4xl font-extrabold tracking-tight text-gray-900 dark:text-slate-600">
      Contact Us</h2>
    <p
      class="mb-8 text-center font-light text-gray-500 dark:text-gray-400 sm:text-xl lg:mb-16">
      Got a technical issue? Want to send feedback about a beta feature? Need
      details about our Business plan? Let us know.</p>

    <form method="POST" action="{{ route('submitted-ticket') }}">
      @csrf
      <label for="name"
        class="mb-2 block text-sm font-medium text-gray-900 dark:text-slate-600">Name</label>
      <input type="text" name="name" id="name"
        placeholder="First and last name"
        class="ark:shadow-sm-light mb-4 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
        value="{{ old('name') }}" required>

      <label for="email"
        class="mb-2 block text-sm font-medium text-gray-900 dark:text-slate-600">Email
        address</label>
      <input type="text" name="email" id="email"
        placeholder="name@example.com"
        class="ark:shadow-sm-light mb-4 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
        value="{{ old('email') }}" required>

      <label for="issue"
        class="mb-2 block text-sm font-medium text-gray-900 dark:text-slate-600">Issue</label>
      <input type="text" name="issue" id="issue" placeholder="Problem"
        class="ark:shadow-sm-light mb-4 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
        value="{{ old('Issue') }}" required>

      <label for="description"
        class="mb-2 block text-sm font-medium text-gray-900 dark:text-slate-600">Description</label>
      <textarea name="description" id="description"
        placeholder="Write an explanation..." rows="6"
        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
        required>{{ old('description') }}</textarea>

      <br>

      <button type="submit"
        class="rounded-lg bg-primary-700 px-5 py-3 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:w-fit">Submit</button>
    </form>
  </div>
</x-public-layout>
