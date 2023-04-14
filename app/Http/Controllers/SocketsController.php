<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocketsController extends Controller
{
    public function connect(Request $request)
    {
        dd("good");
    }
}