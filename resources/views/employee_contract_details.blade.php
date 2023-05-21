<x-app-layout>
  @csrf
  <div class="mx-auto mt-8">
    <a class="mb-2 mr-2 rounded-full bg-gray-800 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
      href="{{ route('employee-view-contracts') }}">back</a></td>
    <form action="{{ route('employee-download-contract') }}" method="POST"
      class="inline-block text-center">@csrf
      <input type="hidden" name="contractID" value="{{ $data['contractID'] }}">
      <button type="submit"
        class="mb-2 mr-2 rounded-full bg-gray-800 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700">Download
        Contract
      </button>
    </form>
  </div>
  @if (@isset($data))
    <div
      class="mx-auto mt-10 h-[1000px] w-[600px] border-2 border-solid border-black">
      <div class="m-5 border-2 border-solid border-black">
        <h1 class="text-center text-xl text-red-600">BlueSky</h1>
        <h1 class="text-center text-xl text-red-600">Employee Contract</h1>
      </div>
      <div class="m-5 border-2 border-solid border-black p-5">
        <h2 class="text-center text-sm">Employee Contract</h2><br>
        <p class="text-center text-sm">Start date: {{ $data['startdate'] }}</p>
        <p class="text-center text-sm">Stop date: {{ $data['stopdate'] }}</p>
        <br>
        <p class="text-sm">
          THIS AGREEMENT made as of {{ $data['created_at'] }}, between
          BlueSky a corporation incorporated under laws and
          {{ $data['last_name'] }} {{ $data['name'] }}.
          having its principal place of business in Belgium and other parts in
          the world.
        </p>
        <br>
        <p class="text-sm">WHEREAS the Employer desires to obtain the benefit of
          the services of the Employee, and the
          Employee desires to render such services on the terms and conditions
          set forth.</p>
        <br>
        <p class="text-sm">IN CONSIDERATION of the promises and other good and
          valuable consideration (the
          sufficiency and receipt of which are hereby acknowledged) the parties
          agree as follows:
          1. Employment
          The Employee agrees that he will at all times faithfully,
          industriously, and to the best of his skill,
          ability, experience and talents, perform all of the duties required of
          his position. In In carrying out
          these duties and responsibilities, the Employee shall comply with all
          Employer policies,
          procedures, rules and regulations, both written and oral, as are
          announced by the Employer from
          time to time. It is also understood and agreed to by the Employee that
          his assignment, duties and
          responsibilities and reporting arrangements may be changed by the
          Employer in its sole
          discretion without causing termination of this agreement.</p>
        <br>
        <p class="text-sm">2. Position Title
          the Employee is required to perform the following duties and undertake
          As a {{ $data['position'] }}
          to
          the following responsibilities in a professional manner</p>
        <br>
        <p class="text-sm">3.
          Compensation
          As full compensation for all services provided the employee shall be
          paid at the rate of {{ $data['salary'] }} Euro per month
          Such payments shall be subject to such normal statutory deductions by
          the
          of
          Employer.</p>
        @if (@isset($data2))
          <br>
          <p class="text-sm">4. Vacation days: <br>
            @foreach ($data2 as $d)
              vacation days for {{ $d['year'] }}: {{ $d['allowed_days'] }}
              <br>
            @endforeach
          </p>
        @endif
      </div>

    </div>
  @endif
</x-app-layout>
