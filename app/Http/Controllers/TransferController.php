<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Models\TransferPoint;
use App\Models\TransferPrice;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index(Request $request) {
        $validatedData = $request->validate([
            'booking-transfer-direction' => ['required', 'integer', 'min:1', 'max:3'],
            'airport-name' => ['required', 'string', 'min:0', 'max:1024'],
            'booking-airport' => ['required', 'integer', 'min:1', 'max:255'],
            'transfer-point-name' => ['required', 'string', 'min:0', 'max:1024'],
            'booking-transfer-point' => ['required', 'integer', 'min:1', 'max:255'],
            'passenger-adult-quantity' => ['required', 'integer', 'min:0', 'max:16'],
            'passenger-kid-quantity' => ['required', 'integer', 'min:0', 'max:16'],
            'passenger-baby-quantity' => ['required', 'integer', 'min:0', 'max:16'],
            'passenger-baby-seat' => ['required', 'integer', 'min:0', 'max:10'],
        ]);

        $formData = $request->post();

        $region = TransferPoint::where('id', $request->post('booking-transfer-point'))
            ->get()
            ->first()
            ->id;

        $transfer = Transfer::where('airport', $request->post('booking-airport'))
            ->where('region', $region)
            ->get()
            ->first()
            ->id;

        $transferPrices = TransferPrice::where('transfer', $transfer)
            ->get();

        $vehicles = Vehicle::all();

        $passengerAdultQuantity = $request->post('passenger-adult-quantity');
        $passengerKidQuantity = $request->post('passenger-kid-quantity');
        $passengerBabyQuantity = $request->post('passenger-baby-quantity');

        $totalQuantity = $passengerAdultQuantity + $passengerKidQuantity + $passengerBabyQuantity;

        $eligibleVehicles = [];

        foreach ($vehicles as $vehicle) {
            foreach ($transferPrices as $transferPrice) {
                $seatQuantityMin = explode('-', $transferPrice->seat_quantity)[0];
                $seatQuantityMax = explode('-', $transferPrice->seat_quantity)[1];

                if ($vehicle->seat_quantity >= $totalQuantity) {
                    if ($seatQuantityMin <= $totalQuantity && $seatQuantityMax >= $totalQuantity) {
                        $eligibleVehicles[] = $vehicle;
                    }
                }
            }
        }

        return view('pages.transfer', compact(['formData', 'eligibleVehicles']));
    }
}
