<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use Illuminate\Http\Request;

use App\Models\MainSlider;
use App\Models\UserReview;

class HomeController extends Controller
{
    public function index()
    {
        $mainSlider = MainSlider::where('is_active', 1)->get();
        $userReviews = UserReview::all();
        $contact = ContactInfo::all()->first();

        return view('pages.home', compact(['mainSlider', 'userReviews', 'contact']));
    }
}
