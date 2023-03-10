@extends('layouts.header')
@section('content')
<div>
         <div>
            <p><a href="/">Home</a></p>
            <p><a href="/new_employee">New employee</a></p>
         </div>
        </div>
         @foreach ($users as $user)
         <div class="userpanel">

            <p>ID: {{ $user->id }}</p>
            <p>first name: {{ $user->firstName }}</p>
            <p>last name: {{ $user->lastName }}</p>
            <p>street: {{ $user->street }}</p>
            <p>province: {{ $user->province }}</p>
         </div>
         @endforeach
@endsection