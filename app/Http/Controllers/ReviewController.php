<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ReviewController extends Controller
{
    public function show(): View|Factory
    {
        return view('review');
    }
    public function save(Request $req): View
    {
        $review = new review();
        $review->rating = $req->rating;
        $review->comment = $req->comment;
        $review->save();
        return view('app');
    }
}
