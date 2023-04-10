<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    public function admin_page(): View|Factory
    {
        return view('admin');
    }

    // WARN: It looks like this is unused!
    public function admin_users_page(): View|Factory
    {
        return view('admin.users');
    }
}
