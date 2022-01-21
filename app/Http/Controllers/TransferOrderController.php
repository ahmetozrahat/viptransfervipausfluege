<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransferOrderController extends Controller
{
    public function index(Request $request) {
        $validated = $request->validate([
            'direction' => ['required', 'integer', 'min:1', 'max:3'],
            'airport' => ['required', 'integer', 'min:1', 'max:255'],
            'airportName' => ['required', 'string', 'min:0', 'max:1024'],
            'transferPoint' => ['required', 'integer', 'min:1'],
            'transferPointName' => ['required', 'string', 'min:0', 'max:1024'],
            'adultQuantity' => ['required', 'integer', 'min:0', 'max:16'],
            'kidQuantity' => ['required', 'integer', 'min:0', 'max:16'],
            'babyQuantity' => ['required', 'integer', 'min:0', 'max:16'],
            'babySeat' => ['required', 'integer', 'min:0', 'max:10'],
            'region' => ['required', 'integer', 'min:1'],
            'vehicle' => ['required', 'integer', 'min:1', 'max:255'],
            'vehicleName' => ['required', 'string', 'min:0', 'max:1024'],
            'price' => ['required', 'integer', 'min:0'],
        ]);

        $formData = $request->post();

        return view('pages.transfer_order', compact('formData'));
    }
}
