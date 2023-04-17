
<link rel="stylesheet" type="text/css" href="{{ asset('css/depot.css') }}" >
<x-app-layout>
<br>
<div class="containerForm">
  
  <h1>Edit Depot</h1>
  @foreach ($depots as $depot)
  <form action="{{ url('editDepotform/'.$depot->id)}}" method="POST">
    @csrf
    <input type="text" name="code" placeholder="Depot Code" value="{{ $depot->code }}"> <br> <br>
    <input type="text" name="location" placeholder="Depot location" value="{{ $depot->address }}"> <br> <br>
    <input type="text" name="size" placeholder="Depot size" value="{{ $depot->size }}"> <br> <br>
    <input type="text" name="filled" placeholder="amount filled" value="{{ $depot->amountFilled }}"> <br> <br>
    <button type="submit">Edit Depot</button>
  </form>
  @endforeach
</div>


</x-app-layout>