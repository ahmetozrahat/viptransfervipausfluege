<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use App\Models\Country;
use App\Models\Terminal;
use Illuminate\Http\Request;

class TransferOrderController extends Controller
{
    public function index(Request $request) {
        $formData = $request->post();
        $countries = Country::all();
        $terminals = Terminal::all();

        $contact = ContactInfo::all()->first();
        return view('pages.transfer_order', compact('formData', 'countries', 'terminals', 'contact'));
    }
}
