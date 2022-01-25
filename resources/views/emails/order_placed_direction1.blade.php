@extends('email')
@section('content')
    <!-- Order Details Section -->
    <div class="order-details">
        <img width="100" height="100" src="data:image/png;base64,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" />
        <div class="order-success-title">{{__('mail_order_placed')}}</div>
        <div class="order-id">{{__('mail_order_id', ['id' => $order->order_id])}}</div>
        <div class="order-details">
            {{__('mail_thanks')}}
        </div>
        <div class="order-details-table-section">
            <table class="order-details-table">
                <tbody>
                <tr class="order-details-row">
                    <td class="order-details-left-col">{{__('mail_name')}}</td>
                    <td class="order-details-right-col">{{$order->name}}</td>
                </tr>
                <tr class="order-details-row">
                    <td colspan="2">
                        <div class="table-seperator">{{__('mail_arrival_info')}}</div>
                    </td>
                </tr>
                <tr class="order-details-row">
                    <td class="order-details-left-col">{{__('mail_land_date')}}</td>
                    <td class="order-details-right-col">{{date('d.m.Y G:i:s', strtotime($order->flight_date))}}</td>
                </tr>
                <tr class="order-details-row">
                    <td class="order-details-left-col">{{__('mail_transfer_point')}}</td>
                    <td class="order-details-right-col">{{$order->transfer_point}}</td>
                </tr>
                <tr class="order-details-row">
                    <td class="order-details-left-col">{{__('mail_flight_no')}}</td>
                    <td class="order-details-right-col">{{$order->flight_no}}</td>
                </tr>
                <tr class="order-details-row">
                    <td class="order-details-left-col">{{__('mail_terminal')}}</td>
                    <td class="order-details-right-col">{{$order->getTerminal->name}}</td>
                </tr>
                <tr class="order-details-row">
                    <td class="order-details-left-col">{{__('mail_transfer_notes')}}</td>
                    <td class="order-details-right-col">{{$order->transfer_notes}}</td>
                </tr>
                <tr class="order-details-row">
                    <td colspan="2">
                        <div class="table-seperator">{{__('mail_return_info')}}</div>
                    </td>
                </tr>
                <tr class="order-details-row">
                    <td class="order-details-left-col">{{__('mail_return_flight_date')}}</td>
                    <td class="order-details-right-col">{{date('d.m.Y G:i:s', strtotime($order->return_flight_date))}}</td>
                </tr>
                <tr class="order-details-row">
                    <td class="order-details-left-col">{{__('mail_return_transfer_date')}}</td>
                    <td class="order-details-right-col">{{date('d.m.Y G:i:s', strtotime($order->return_transfer_date))}}</td>
                </tr>
                <tr class="order-details-row">
                    <td class="order-details-left-col">{{__('mail_return_transfer_point')}}</td>
                    <td class="order-details-right-col">{{$order->pickup_point}}</td>
                </tr>
                <tr class="order-details-row">
                    <td class="order-details-left-col">{{__('mail_return_flight_no')}}</td>
                    <td class="order-details-right-col">{{$order->return_flight_no}}</td>
                </tr>
                <tr class="order-details-row">
                    <td class="order-details-left-col">{{__('mail_return_terminal')}}</td>
                    <td class="order-details-right-col">{{$order->getReturnTerminal->name}}</td>
                </tr>
                <tr class="order-details-row">
                    <td class="order-details-left-col">{{__('mail_return_transfer_notes')}}</td>
                    <td class="order-details-right-col">{{$order->return_transfer_notes}}</td>
                </tr>
                <tr class="order-details-row">
                    <td class="order-details-left-col">{{__('mail_payment_method')}}</td>
                    <td class="order-details-right-col">{{__('mail_default_payment_method')}}</td>
                </tr>
                <tr class="order-details-row">
                    <td class="order-details-left-col">{{__('mail_transfer_price')}}</td>
                    <td class="order-details-right-col">
                        {{$order->converted_price . ' '}}
                        @switch($order->currency)
                            @case('tl')
                            ₺
                            @break
                            @case('usd')
                            $
                            @break
                            @default
                            €
                            @break
                        @endswitch
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
