@extends('layouts.header')
@section('content')
  <style>
    body {
      background-color: #fbfbfb;
    }

    @media (min-width: 991.98px) {
      main {
        padding-left: 240px;
      }
    }

    .sidebar {
      position: fixed;
      top: 48px;
      bottom: 0;
      left: 0;
      padding: 58px 0 0;
      box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
      width: 240px;
      z-index: 600;
    }

    @media (max-width: 991.98px) {
      .sidebar {
        width: 100%;
      }
    }

    .sidebar .active {
      border-radius: 5px;
      box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
    }

    .sidebar-sticky {
      position: relative;
      top: 0;
      height: calc(100vh - 48px);
      padding-top: 0.5rem;
      overflow-x: hidden;
      overflow-y: auto;
    }

    .container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 10px;
    width: 100%;
    margin: auto;
    }
    input {
        width: 100%;
        margin-top: 10px;
        margin-bottom: 10px;
        border: 1px solid black;
        border-radius: 4px;
        padding: 8px;
        box-sizing: border-box;
    }
  </style>
  <div class="">
    <nav id="sidebarMenu" class="d-lg-block sidebar bg-white">
      <a href="contractsMenu">
        <h1><b>Contracts</b></h1>
      </a>
      <div class="list-group list-group-flush mx-3 mt-4">
        <ul>
          <li><a href="contract_list"
              class="list-group-item list-group-item-action ripple py-2">
              <span>contract list</span>
            </a></li>
          <li><a href="new_contract"
              class="list-group-item list-group-item-action ripple py-2"><span>new
                contract</span></a></li>
          <li><a href="contract"
              class="list-group-item list-group-item-action ripple py-2">
              <span>edit contract</span>
            </a></li>
          <li> <a href="airportList"
              class="list-group-item list-group-item-action ripple py-2"><span>airport
                list</span></a></li>
                <li> <a href="addAirportList"
              class="list-group-item list-group-item-action ripple py-2"><span>add airport</span></a>
          </li>
        </ul>
      </div>
    </nav>
    
    
    <main style="margin-top: 58px">
      <div class="container pt-4">
        <div class="">
        <h1>Add airport</h1>
            <form action="airportList/add" method="POST" autocomplete="off">
              @csrf

              <label for="iata_code">IATA code</label> <br>
              <input type="text" maxlength="3" name="iata_code" required> <br> <br>

              <label for="name">Airport Name</label> <br>
              <input type="text" name="name" required> <br> <br>

              <label for="land">Country</label> <br>
              <input type="text" name="land" required> <br> <br>

              <label for="address_id">Address ID</label> <br>
              <input type="number" maxlength="20" name="address_id" required> <br> <br>

              <button type="submit">Add airport</button>
            </form>
        </div>
      </div>
    </main>

    <div>

    </div>
  </div>
@endsection




