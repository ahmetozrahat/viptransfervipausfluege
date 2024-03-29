<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use App\Models\TransferOrder;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    public function index($lang, $order_id) {
        $contact = ContactInfo::all()->first();
        $order = TransferOrder::where('order_id', $order_id)->get()->first();

        if ($order != null){
            switch ($order->direction) {
                case 1:
                    return view('pages.order_details_direction1', compact(['order', 'contact']));
                case 2:
                    return view('pages.order_details_direction2', compact(['order', 'contact']));
                case 3:
                    return view('pages.order_details_direction3', compact(['order', 'contact']));
                default:
                    return view('pages.order_details_not_found', compact('contact'));
            }
        }
        return view('pages.order_details_not_found', compact('contact'));
    }

    public function check(Request $request) {
        $order_id = $request->post('order_id');
        $email = $request->post('email');

        $order = TransferOrder::where('order_id', $order_id)
            ->where('email', $email)
            ->get()
            ->first();

        if ($order != null)
            return true;

        return false;
    }
}
