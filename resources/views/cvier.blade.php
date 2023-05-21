<!DOCTYPE html>
<html>

<head>
  <title>Contract of Determination</title>
</head>

<body>
  <div class="bg-gray-200 p-4">
    <h1 class="text-center text-3xl font-bold text-blue-500">Contract of
      Determination</h1>
  </div>
  <div class="p-8">
    <h2 class="mb-4 text-xl font-bold">Employee Information:</h2>
    <p class="mb-4"><span class="font-semibold">Employee First Name:</span>
      {{ $employee->user->name }}</p>
    <p class="mb-4"><span class="font-semibold">Employee Last Name:</span>
      {{ $employee->user->last_name }}</p>

    <h2 class="mb-4 mt-8 text-xl font-bold">Contract Details:</h2>
    <p class="mb-4"><span class="font-semibold">Contract ID:</span>
      {{ $employee->id }}</p>
    <p class="mb-4"><span class="font-semibold">Start Date:</span>
      {{ $contract->start_date }}</p>
    <p class="mb-4"><span class="font-semibold">End Date:</span>
      {{ $contract->end_date }}</p>
    <p class="mb-4"><span class="font-semibold">Determination Date:</span>
      {{ date('Y-m-d H:i:s') }}</p>

    <h2 class="mb-4 mt-8 text-xl font-bold">Employment Terms:</h2>
    <p>This contract of determination is entered into by and between the
      employer ("BlueSky") and the employee ("{{ $employee->user->name }}
      {{ $employee->user->last_name }}").</p>
    <p>The Contract of Determination outlines the terms and conditions of the
      Employee's employment with the Company.</p>

    <p>The Employee will be employed for a specific project or a fixed period,
      and the contract will automatically terminate upon the completion of the
      project or at the end of the specified period.</p>

    <h2 class="mb-4 mt-8 text-xl font-bold">Confidentiality:</h2>
    <p>The Employee agrees to maintain the confidentiality of any proprietary or
      confidential information disclosed by the Company during the course of
      employment.</p>

    <h2 class="mb-4 mt-8 text-xl font-bold">Termination:</h2>
    <p>The Contract of Determination will terminate automatically upon the
      completion of the project or at the end of the specified period.</p>
    <p>Either party may terminate the contract earlier with written notice and
      in accordance with the agreed-upon notice period.</p>
    <p>Upon termination, the Employee may be entitled to any applicable benefits
      or compensation as per the Company's policies and applicable laws.</p>
  </div>
  <div class="mt-8 text-center">
    <p class="text-gray-500">Generated on: {{ date('Y-m-d H:i:s') }}</p>
  </div>
</body>

</html>
