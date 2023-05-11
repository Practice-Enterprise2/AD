<x-app-layout>
<table>

    <tr>
        <th>Name</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Action</th>
    </tr>
    @foreach ($employees as $employee)
        <tr>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->current_contract ? $employee->current_contract->start_date->format('Y-m-d') : '' }}</td>
            <td>{{ $employee->current_contract ? $employee->current_contract->end_date->format('Y-m-d') : '' }}</td>
            <td>
                <form method="POST" action="{{ route('contracts.renew', $employee->current_contract) }}">
                    @csrf
                    <button type="submit">Renew Contract</button>
                </form>
                <form method="POST" action="{{ route('contracts.determine', $employee->id) }}">
                    @csrf
                    <button type="submit">Determine Contract</button>
                </form>
            </td>
        </tr>
    @endforeach

</table>

</x-app-layout>