
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
  height: 100vh; /* make the container take up the full height of the viewport */
}

.mini-container {
  max-width: 500px; /* set a max width for the form */
  width: 100%; /* make the form take up the full width of its container */
  padding: 20px;
  box-sizing: border-box;
  
  text-align: center;
}

@media (max-width: 767px) {
  .container {
    padding: 0 10px; /* reduce padding on smaller screens */
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
        <td><input type="text" name="name" id="name" value="{{ $customer->name }}"></td>
    </tr>
    <tr>
        <td><label for="email">Email</label></td>
        <td><input type="email" name="email" id="email" value="{{ $customer->email }}" readonly></td>
    </tr>
    <tr>
        <td><label for="phone">Phone</label></td>
        <td><input type="text" name="phone" id="phone" value="{{ $customer->phone }}"></td>
    </tr>
    <tr>
        <td><label for="role">Role</label></td>
        <td><input type="text" name="role" id="role" value="{{ $customer->role }}"></td>
    </tr>
                
<tr>
    <td colspan="2" style="text-align: center;background-color: var(--lgrey);"><button type="submit">Update</button></td>
</tr>

                
            </table>
            </form>
        </div>
    </div>
</x-app-layout>