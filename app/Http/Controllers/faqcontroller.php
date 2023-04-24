<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class faqcontroller extends Controller
{
    public function show(): View|Factory {
        return view("faq.show");
    }
}
