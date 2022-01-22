<?php

namespace App\Http\Controllers;

use App\Models\TransferOrder;
use Illuminate\Http\Request;

class CreateOrderController extends Controller
{
    public function create(Request $request) {
        $order = new TransferOrder;

        $order->order_id = $request->post('order_id');
        $order->name = $request->post('name');
        $order->email = $request->post('email');
        $order->phone = $request->post('phone');
        $order->country = $request->post('country');
        $order->direction = $request->post('direction');
        $order->airport = $request->post('airport');
        $order->destination = $request->post('destination');
        $order->passenger_quantity = $request->post('passengers');
        $order->baby_seat = $request->post('baby_seat');
        $order->vehicle = $request->post('vehicle');
        $order->flight_date = $request->post('flight_date');
        $order->flight_no = $request->post('flight_no');
        $order->terminal = $request->post('terminal');
        $order->transfer_date = $request->post('transfer_date');
        $order->transfer_point = $request->post('transfer_point');
        $order->transfer_notes = $request->post('transfer_notes');
        $order->return_flight_date = $request->post('return_flight_date');
        $order->return_transfer_date = $request->post('return_transfer_date');
        $order->return_flight_no = $request->post('return_flight_no');
        $order->return_terminal = $request->post('return_terminal');
        $order->pickup_point = $request->post('pickup_point');
        $order->return_transfer_notes = $request->post('return_transfer_notes');
        $order->original_price = $request->post('original_price');
        $order->converted_price = $request->post('converted_price');
        $order->lang = $request->post('lang');
        $order->currency = $request->post('currency');
        $order->email_list_agreed = $request->post('email_list_agreed') == true ? 1 : 0;

        $order->save();

        return true;
    }
}
