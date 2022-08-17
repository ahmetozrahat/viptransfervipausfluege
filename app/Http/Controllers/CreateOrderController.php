<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Mail\OrderPlacedAdmin;
use App\Models\AdminAccount;
use App\Models\TransferOrder;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CreateOrderController extends Controller
{
    public function create(Request $request) {
        if ($this->createOrder($request)) {
            // Row inserted successfully.
            // Send Mail and SMS to both user and admins.
            $order = TransferOrder::where('order_id', $request->post('order_id'))->get()->first();

            if ($order != null) {
                // Mail to the user
                Mail::to($request->post('email'))
                    ->locale($request->post('lang'))
                    ->send(new OrderPlaced($order));

                // Mail to the admin
                Mail::to('info@viptransfervipausfluege.com')
                    ->cc(AdminAccount::where('is_active', true)->get()->all())
                    ->locale($request->post('lang'))
                    ->send(new OrderPlacedAdmin($order));

                // Send notification for admin panel.
                $data = [
                    'app_id' => env('ONESIGNAL_APP_ID', ''),
                    'included_segments' => ['Subscribed Users'],
                    'headings' => [
                        'en' => $order->name . ' • Yeni Sipariş'
                    ],
                    'contents' => [
                        'en' => $order->order_id . ' nolu yeni siparişe göz atmak için dokunun.'
                    ],
                    'data' => [
                        'order_id' => $order->order_id
                    ]
                ];

                Http::contentType('application/json')
                    ->acceptJson()
                    ->withToken(env('ONESIGNAL_REST_API_KEY', ''))
                    ->post('https://onesignal.com/api/v1/notifications', $data);

                // SMS to the user (disabled for now.)
                /*$smsUser = __(
                    'order_confirmation_sms_user',
                    [
                        'name' => $request->post('name'),
                        'order_id' => $request->post('order_id')
                    ],
                    $request->post('lang')
                );
                // SMSController::sendMessage($request->post('phone'), $smsUser);

                // SMS to the admin
                $smsUser = __('order_confirmation_sms_admin', [], $request->post('lang'));
                SMSController::sendMessage('+905441700738', $smsUser);*/
            }else {
                return false;
            }
        }else {
            return false;
        }

        return true;
    }

    private function createOrder(Request $request): Bool {
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

        $result = $order->save();

        return $result;
    }
}
