{{-- -*-html-*- --}}

<div>
  <table>
    <tr class="border-2 border-black dark:border-white">
      <th class="border-2 border-black dark:border-white">First Name</th>
      <th class="border-2 border-black dark:border-white">Last Name</th>
      <th class="border-2 border-black dark:border-white">Email</th>
      <th class="border-2 border-black dark:border-white">Iban</th>
      <th class="border-2 border-black dark:border-white">Job Title</th>
    </tr>
    @foreach ($employee_users as $employee_user)
      <tr class="h-full border-2 border-black dark:border-white">
        <td class="border-2 border-black dark:border-white">
          {{ $employee_user->name }}
        </td>
        <td class="border-2 border-black dark:border-white">
          {{ $employee_user->last_name }}
        </td>
        <td class="border-2 border-black dark:border-white">
          {{ $employee_user->email }}
        </td>
        <td class="border-2 border-black dark:border-white">
          {{ $employee_user->employee->Iban }}
        </td>
        <td class="border-2 border-black dark:border-white">
          {{ $employee_user->employee->jobTitle }}
        </td>
      </tr>
    @endforeach
  </table>
</div>
