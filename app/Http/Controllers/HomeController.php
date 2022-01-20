<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MainSlider;
use App\Models\UserReview;

class HomeController extends Controller
{
    public function index()
    {
        $mainSlider = MainSlider::all();
        $userReviews = UserReview::all();

        return view('pages.home', compact(['mainSlider', 'userReviews']));
    }
}
