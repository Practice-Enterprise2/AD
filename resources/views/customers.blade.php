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
                <th>last_name</th>
                <th>email</th>
                <th>phone</th>
                <th>adres</th>
                <th>region</th>
                <th>country</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            
            <td>{{ $user->address->street}} {{ $user->address->house_number }},{{ $user->address->postal_code }} {{ $user->address->city }}</td>
            <td>{{ $user->address->region }}</td>
            <td>{{ $user->address->country }}</td>
           
            
            <td>
            <a href="{{ route('customer.edit', $user->id) }}"><button style="border: solid 2px grey ;padding: 5px">Edit</button></a>


            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>





</x-app-layout>