<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class ReviewController extends Controller
{
    public function show(): View
    {
        return view('review');
    }

    public function save(Request $req): View
    {
        $review = new Review();
        $review->rating = $req->rating;
        $review->comment = $req->comment;
        $review->save();

        return view('app');
    }

    public function showread(): View
    {
        $reviews = FacadesDB::select('select * from reviews');
        $rating = null;

        return view('readreviews', ['review' => $reviews, 'rating' => $rating]);
    }

    public function filter(Request $request): View
    {
        $reviews = FacadesDB::select('select * from reviews');
        $rating = $request->input('rating');

        return view('readreviews', ['review' => $reviews, 'rating' => $rating]);
    }
}
