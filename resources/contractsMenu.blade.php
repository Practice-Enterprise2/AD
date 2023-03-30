<?php

use App\Http\Controllers\contractController;

if (!isset($_GET["q"]))
{
    ?>
    <script>
        this.location.replace("/contract?q=1");
    </script>
    <?php
}

?>
@extends('layouts.header')
@section('content')
<!-- example -->
<style>
                
                .x
                {
                    
                    width: 100%;
                    border: 1px outset grey;
                    margin-bottom: 50px;
                }
                table
                {
                        margin: 0 auto;
                        border: 1px solid black;
                }
                .x td
                {
                    margin-left: 10px;
                }
    </style>
<style>
            body {
        background-color: #fbfbfb;
        }
        @media (min-width: 991.98px) {
        main {
            padding-left: 240px;
        }
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 48px;
            bottom: 0;
            left: 0;
            padding: 58px 0 0; /* Height of navbar */
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
        overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        }
</style>
<div class="">
<!-- Sidebar -->
<nav
       id="sidebarMenu"
       class=" d-lg-block sidebar bg-white"
       >
       <a href="page2"><h1><b>Contracts</b></h1></a>
      <div class="list-group list-group-flush mx-3 mt-4">
        <ul>
            <li><a
           href="#"
           class="list-group-item list-group-item-action py-2 ripple "
           >
          <span>contract list</span>
        </a></li>
        <li><a
           href="test"
           class="list-group-item list-group-item-action py-2 ripple"
           ><span>new contract</span></a
          ></li>
          <li><a
           href="contract"
           class="list-group-item list-group-item-action py-2 ripple"
           >
          <span>edit contract</span>
        </a></li>
        <li>        <a
           href="airportList"
           class="list-group-item list-group-item-action py-2 ripple"
           ><span>airport list</span></a
          ></li>
        </ul>
    </div>
  </nav>
  <!-- Sidebar -->
  <!--Main layout-->
<main style="margin-top: 58px">
  <div class="container pt-4">
  <div class="">
        @yield('content')
    </div>
  </div>
</main>
<!--Main layout-->
<div>

</div>
</div>
@endsection



    


