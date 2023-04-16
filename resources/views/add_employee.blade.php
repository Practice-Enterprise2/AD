@extends('layouts.header')
<x-app-layout>
<style>
h1 {
    padding-top: 50px;
    text-align: center;
}
div#everything {
    background-color: lightblue;
    width: 80%;
    margin: auto;
}
form {
    text-align: center;
    padding-top: 50px;
}

input {
    margin-bottom: 20px;
}
form button {
    border-radius: 250px;
    color: darkgoldenrod;
    font-size: large;
    margin: 50px;
    padding: 15px;
    width: 200px;
}
form button:hover {
    background-color: blueviolet;
    color: black;
}
</style>
        <h1>New Employee</h1>
        <form method="post" action="employee_add" accept-charset="UTF-8">
            @csrf
            <div id="left">
            <label for="firstName">First name:</label>
            <input type="text" id="firstName" name="firstName" required><br>
            <label for="lastName">Last name:</label>
            <input type="text" id="lastName" name="lastName" required><br>
            <label for="street">street:</label>
            <input type="text" id="street" name="street" required><br>
            <label for="province">province:</label>
            <input type="text" id="province" name="province" required><br>
            <label for="city">city:</label>
            <input type="text" id="city" name="city" required><br>
            <label for="postalCode">postalcode:</label>
            <input type="number" id="postalCode" name="postalCode" required><br>
            <label for="phonenumber">phonenumber:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" required><br>
            </div>
            <div id="right">
            <label for="mail">mail:</label>
            <input type="email" id="mail" name="mail" required><br>
            <label for="dateOfBirth">date of birth:</label>
            <input type="date" id="dateOfBirth" name="dateOfBirth" required><br>
            <label for="jobTitle">job title:</label>
            <input type="text" id="jobTitle" name="jobTitle" required><br>
            <label for="salary">salary:</label>
            <input type="number" id="salary" name="salary" required><br>
            <label for="password">password:</label>
            <input type="password" id="password" name="password" required><br>
            <label for="Iban">Iban:</label>
            <input type="int" id="Iban" name="Iban" required><br>
            <label for="isActive">active:</label>
            <select name="isActive" id="isActive" value="yes">
                <option value="yes">yes</option>
                <option value="no">no</option>
            </select>
            </div>
            <br>
            <a href="{{ route('home'); }}">Back</a>
            <button type="reset">reset</button>
            <button type="submit">New</button>
        </form>
</x-app-layout>
