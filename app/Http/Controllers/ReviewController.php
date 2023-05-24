<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class ReviewController extends Controller
{
    public function create(): View
    {
        return view('review');
    }

    /**
     * Store the review and 'redirect' the user to their profile page.
     */
    public function store(Request $req): RedirectResponse
    {
        $review = new Review();
        $review->rating = $req->rating;
        $review->comment = $req->comment;
        $review->save();

        return redirect()->route('home');
    }

    /**
     * Return a view showing all the reviews with the given rating.
     */
    public function index(Request $request): View
    {
        $reviews = FacadesDB::select('select * from reviews');
        $rating = $request->input('rating');

        return view('reviews.index', ['review' => $reviews, 'rating' => $rating]);
    }
}
