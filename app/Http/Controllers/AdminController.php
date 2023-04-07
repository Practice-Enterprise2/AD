<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function admin_page(): View|Factory
    {
        return 'admin' == Auth::user()->roles()->first()->name ? view('admin') : abort(Response::HTTP_NOT_FOUND);
    }

    public function admin_users_page(): View|Factory
    {
        return 'admin' == Auth::user()->roles()->first()->name ? view('admin.users') : abort(Response::HTTP_NOT_FOUND);
    }
}
