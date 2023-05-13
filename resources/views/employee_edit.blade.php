<x-app-layout>
  <style>
  .employee-edit-fix:after{
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
  }
</style>  
<div class="mx-auto">
  <h1 class="text-center m-5">Employee Edit</h1>
  <h1 class="text-center m-5">{{$array["name"]}} {{$array["lastName"]}}</h1>
  <div class="bg-gray-200 p-8">
  <form method="post" action="employee_edit_save" accept-charset="UTF-8">
  <input type="hidden" name="userId" value="{{ $array['userID'] }}">
    @csrf
    <div class="employee-add-fix">
    <div id="left" class="float-left w-60">
      <label for="firstName" >First name:</label>
      <br><br>
      
      <label for="lastName" >Last name:</label>
      <br><br>
      <label for="mail">mail:</label>
      <br><br>
      <label for="street">street:</label>
      <br><br>
      <label for="houseNumber">house number:</label>
      <br><br>
      <label for="province">province:</label>
      <br><br>
      <label for="city">city:</label>
      <br><br>
      <label for="postalCode">postalcode:</label><br><br>
      <label for="country">country:</label>
      <br><br>
      <label for="phonenumber">phonenumber:</label>
      <br><br>
      <label for="dateOfBirth">date of birth:</label><br><br>
      <label for="jobTitle">job title:</label><br><br>
      <label for="salary">salary:</label><br><br>
      <label for="password">password:</label><br><br>
      <label for="Iban">Iban:</label>
    </div>
    <div id="right" class="float-left">
      
      <input type="text" id="Name" name="name" ><br><br>
      
      <input type="text" id="lastName" name="last_name" ><br><br>
      
      <input type="email" id="mail" name="email" ><br><br>
      
      <input type="text" id="street" name="street" ><br><br>
      
      <input type="text" id="houseNumber" name="houseNumber" ><br><br>
      
      <input type="text" id="province" name="province" ><br><br>
      
      <input type="text" id="city" name="city" ><br><br>
      
      <input type="number" id="postalCode" name="postalCode" ><br><br>
      
      <input type="text" id="country" name="country" ><br><br>
      
      <input type="tel" id="phoneNumber" name="phoneNumber" ><br><br>
      
      <input type="date" id="dateOfBirth" name="dateOfBirth" ><br><br>
      
      <input type="text" id="jobTitle" name="jobTitle" ><br><br>
      
      <input type="number" id="salary" name="salary" ><br><br>
      
      <input type="password" id="password" name="password" ><br><br>
      
      <input type="int" id="Iban" name="Iban"><br><br>
    </div>
    </div>
    <div class="text-center mt-2">
    <a href="{{ route('employee.overview') }}" class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">Back</a>
    <button type="reset" class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">reset</button>
    <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">Save
    </button>
    </div>
  </form>
  </div>
  </div>
</x-app-layout>
