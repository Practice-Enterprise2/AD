<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class FaqController extends Controller
{
    public function show(): View|Factory
    {
        return view('faq.show');
    }
}
