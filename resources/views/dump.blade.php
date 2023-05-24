{{-- -*-html-*- --}}

<x-app-layout>
  <html>

  <head>
    <title>Ticket Data Dump</title>
  </head>

  <body>
    <h1>Ticket Data Dump</h1>
    <pre>
            {{ var_dump($tickets) }}
        </pre>
  </body>

  </html>
</x-app-layout>
