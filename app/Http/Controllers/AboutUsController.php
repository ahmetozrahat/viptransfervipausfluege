<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use App\Models\Gallery;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $contact = ContactInfo::all()->first();
        $gallery = Gallery::orderBy('id', 'desc')->get();

        return view('pages.aboutus', compact(['gallery', 'contact']));
    }
}
