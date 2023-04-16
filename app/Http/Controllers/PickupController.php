<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PickupController extends Controller
{
    public function index(): View|Factory
    {
        return view('dashboard.my_pickups');
    }

    public function create(): View|Factory
    {
        return view('create-pickup');
    }
}
