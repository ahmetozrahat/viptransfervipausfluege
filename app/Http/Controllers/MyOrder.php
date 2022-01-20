<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyOrder extends Controller
{
    public function index()
    {
        return view('pages.myorder');
    }
}
