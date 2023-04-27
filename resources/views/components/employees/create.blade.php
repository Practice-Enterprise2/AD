<div>
  <h1 class="pt-[50px] text-center">New Employee</h1>
  <form method="post" action="employee_add" accept-charset="UTF-8"
    class="pt-[50px] text-center">
    @csrf
    <div id="left">
      <label for="firstName">First name:</label>
      <input type="text" id="firstName" name="firstName" class="mb-[20px]"
        required><br>
      <label for="lastName">Last name:</label>
      <input type="text" id="lastName" name="lastName" class="mb-[20px]"
        required><br>
      <label for="street">street:</label>
      <input type="text" id="street" name="street" class="mb-[20px]"
        required><br>
      <label for="province">province:</label>
      <input type="text" id="province" name="province" class="mb-[20px]"
        required><br>
      <label for="city">city:</label>
      <input type="text" id="city" name="city" class="mb-[20px]"
        required><br>
      <label for="postalCode">postalcode:</label>
      <input type="number" id="postalCode" name="postalCode" class="mb-[20px]"
        required><br>
      <label for="phonenumber">phonenumber:</label>
      <input type="tel" id="phoneNumber" name="phoneNumber"
        class="mb-[20px]" required><br>
    </div>
    <div id="right">
      <label for="mail">mail:</label>
      <input type="email" id="mail" name="mail" class="mb-[20px]"
        required><br>
      <label for="dateOfBirth">date of birth:</label>
      <input type="date" id="dateOfBirth" name="dateOfBirth"
        class="mb-[20px]" required><br>
      <label for="jobTitle">job title:</label>
      <input type="text" id="jobTitle" name="jobTitle" class="mb-[20px]"
        required><br>
      <label for="salary">salary:</label>
      <input type="number" id="salary" name="salary" class="mb-[20px]"
        required><br>
      <label for="password">password:</label>
      <input type="password" id="password" name="password" class="mb-[20px]"
        required><br>
      <label for="Iban">Iban:</label>
      <input type="int" id="Iban" name="Iban" class="mb-[20px]"
        required><br>
      <label for="isActive">active:</label>
      <select name="isActive" id="isActive" value="yes">
        <option value="yes">yes</option>
        <option value="no">no</option>
      </select>
    </div>
    <br>
    <a href="{{ route('home') }}">Back</a>
    <button type="reset"
      class="bg-red m-[50px] w-[200px] rounded-[250px] p-[15px] text-2xl hover:bg-violet-500 hover:text-black">reset</button>
    <button type="submit"
      class="bg-red m-[50px] w-[200px] rounded-[250px] p-[15px] text-2xl hover:bg-violet-500 hover:text-black">New</button>
  </form>
</div>
