<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use Illuminate\Http\Request;

class MyOrderController extends Controller
{
    public function index()
    {
        $contact = ContactInfo::all()->first();
        return view('pages.myorder', compact('contact'));
    }
}
