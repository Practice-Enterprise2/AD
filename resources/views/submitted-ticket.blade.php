{{-- -*-html-*- --}}

<x-app-layout>
  <div>

    <h1>Ticket submitted successfully</h1>

    <p>Thank you for submitting your ticket! We will try and resolve it as
      quickly as possible.</p>

    <ul>
      <li><strong>{{ $ticket->issue }}</strong></li>
      <li><strong>{{ $ticket->description }}</strong></li>
    </ul>

  </div>
</x-app-layout>
