<x-app-layout>
<style>
    :root {
        --lgrey: #e0e0e0;
       
        --eLgrey: #f9f9f9;
    }

    h1 {
        text-align: center;
    }

    .tableContainer {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .tableCust {
        border-collapse: collapse;
        width: 80%;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: var(--lgrey);
        font-size: 20px;
     
    }

    tr:hover {
    background-color: var(--lgrey);
}
</style>
<h1>Customer Overview</h1>
<div class="tableContainer">
    <table class="tableCust">
        <thead>
            <tr>
                <th>name</th>
                <th>email</th>
                <th>phone</th>
                <th>role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->role }}</td>
            <td>
            <a href="{{ route('customer.edit', $user->id) }}"><button>Edit</button></a>


            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>





</x-app-layout>