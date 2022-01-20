<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MainSlider;

class HomeController extends Controller
{
    public function index()
    {
        $data = MainSlider::all();
        return view('pages.home', compact('data'));
    }
}
