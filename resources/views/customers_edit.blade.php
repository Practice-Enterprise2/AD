
<x-app-layout>
<style>
    :root {
        --lgrey: #e0e0e0;
       
        --eLgrey: #f9f9f9;
    }
    .container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.mini-container {
  max-width: 500px;
  width: 100%;
  padding: 20px;
  box-sizing: border-box;

}

@media (max-width: 767px) {
  .container {
    padding: 0 10px; 
  }
}
h1{
    font-size: 30px;
}
td{
    width: 10%;
    height: 20px;
}
input{
    width: 100%;
    border: black solid 1px;
}
tr{
  
   height: 50px;
}


</style>
    
    <div class="container">
        
        <div class="mini-container">
            <h1>Edit Customer</h1>
            <form action="{{ route('customer.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')
<table>
    <tr>
        <td><label for="name">Name</label></td>
        <td><input type="text" name="name" id="name" value="{{ $customer->name }}"> @error('name') <div class="text-danger">{{ $message }}</div>@enderror</td>
    </tr>
    <tr>
        <td><label for="last_name">last_name</label></td>
        <td><input type="text" name="last_name" id="last_name" value="{{ $customer->last_name }}">@error('last_name') <div class="text-danger">{{ $message }}</div>@enderror</td>
    </tr>
    <tr>
        <td><label for="email">Email</label></td>
        <td><input type="email" name="email" id="email" value="{{ $customer->email }}" readonly></td>
    </tr>
    <tr>
        <td><label for="phone">Phone</label></td>
        <td><input type="text" name="phone" id="phone" value="{{ $customer->phone }}">@error('phone') <div class="text-danger">{{ $message }}</div>@enderror</td>
    </tr>

    <tr>
        <td><label for="street">street</label></td>
        <td><input type="text" name="street" id="street" value="{{ $customer->address->street }}">@error('street') <div class="text-danger">{{ $message }}</div>@enderror</td>
    </tr>  


    <tr>
        <td><label for="house_number">house_number</label></td>
        <td><input type="text" name="house_number" id="house_number" value="{{ $customer->address->house_number }}">@error('house_number') <div class="text-danger">{{ $message }}</div>@enderror</td>
    </tr>  
    <tr>
        <td><label for="postal_code">postal_code</label></td>
        <td><input type="text" name="postal_code" id="postal_code" value="{{ $customer->address->postal_code }}">@error('postal_code') <div class="text-danger">{{ $message }}</div>@enderror</td>
    </tr>  
    <tr>
        <td><label for="city">city</label></td>
        <td><input type="text" name="city" id="city" value="{{ $customer->address->city }}">@error('city') <div class="text-danger">{{ $message }}</div>@enderror</td>
    </tr>  
    <tr>
        <td><label for="region">region</label></td>
        <td><input type="text" name="region" id="region" value="{{ $customer->address->region }}">@error('region') <div class="text-danger">{{ $message }}</div>@enderror</td>
    </tr>  
    <tr>
        <td><label for="country">country</label></td>
        <td><input type="text" name="country" id="country" value="{{ $customer->address->country }}">@error('country') <div class="text-danger">{{ $message }}</div>@enderror</td>
    </tr>  
    


<tr>
    <td colspan="2" style="text-align: center;background-color: var(--lgrey);"><button type="submit">Update</button></td>
</tr>

                
            </table>
            </form>
        </div>
    </div>
</x-app-layout>