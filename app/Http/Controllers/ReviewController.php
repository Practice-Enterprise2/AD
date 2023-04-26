<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB as FacadesDB;

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
    public function showread(): View|Factory
    {
        $reviews = FacadesDB::select('select * from reviews');
        $rating = null;

        return view('readreviews', ['review' => $reviews,'rating' => $rating]);
        
    }
    public function filter(Request $request): View|Factory
    {
        $reviews = FacadesDB::select('select * from reviews');
        $rating = $request->input('rating');

        return view('readreviews', ['review' => $reviews, 'rating' => $rating]);
    }
}
