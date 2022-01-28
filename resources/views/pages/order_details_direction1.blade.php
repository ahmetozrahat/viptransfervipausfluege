@extends('main')
@section('title')
    {{__('tab_title_order_details', ['company' => 'VipTransferVipAusfluege'])}}
@endsection
@section('content')
    <!-- Page Header Section -->
    <div class="page-header about-us">
        <div id="order-created-page-title" class="page-title" style="text-align: left;">
            {{__('order_details_title')}}
        </div>
    </div>

    <!-- Order Details Section -->
    <div class="order-details">
        <i class="fas fa-check-circle order-success"></i>
        <div id="order-success-title" class="order-success-title">{{__('mail_order_placed')}}</div>
        <div id="order-id" class="order-id">{{__('mail_order_id', ['id' => $order->order_id])}}</div>
        <div id="order-details" class="order-details">
            {!! __('mail_order_copy', ['email' => $order->email]) !!}
        </div>
        <div class="order-details-table-section">
            <table class="order-details-table">
                <tbody>
                <tr class="order-details-row">
                    <td id="order-details-name" class="order-details-left-col">{{__('mail_name')}}</td>
                    <td class="order-details-right-col">{{$order->name}}</td>
                </tr>
                <tr class="order-details-row">
                    <td colspan="2" class="order-details-center-col">
                        <div id="seperator-normal" class="table-seperator">{{__('mail_arrival_info')}}</div>
                    </td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-land-date" class="order-details-left-col">{{__('mail_land_date')}}</td>
                    <td class="order-details-right-col">{{date('d.m.Y G:i:s', strtotime($order->flight_date))}}</td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-transfer-point" class="order-details-left-col">{{__('mail_transfer_point')}}</td>
                    <td class="order-details-right-col">{{$order->transfer_point}}</td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-flight-no" class="order-details-left-col">{{__('mail_flight_no')}}</td>
                    <td class="order-details-right-col">{{$order->flight_no}}</td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-terminal" class="order-details-left-col">{{__('mail_terminal')}}</td>
                    <td class="order-details-right-col">{{$order->getTerminal->name}}</td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-notes" class="order-details-left-col">{{__('mail_transfer_notes')}}</td>
                    <td class="order-details-right-col">{{$order->transfer_notes}}</td>
                </tr>
                <tr class="order-details-row">
                    <td colspan="2" class="order-details-center-col">
                        <div id="seperator-return" class="table-seperator">{{__('mail_return_info')}}</div>
                    </td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-return-flight-date" class="order-details-left-col">{{__('mail_return_flight_date')}}</td>
                    <td class="order-details-right-col">{{date('d.m.Y G:i:s', strtotime($order->return_flight_date))}}</td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-return-transfer-date" class="order-details-left-col">{{__('mail_return_transfer_date')}}</td>
                    <td class="order-details-right-col">{{date('d.m.Y G:i:s', strtotime($order->return_transfer_date))}}</td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-return-transfer-point" class="order-details-left-col">{{__('mail_return_transfer_point')}}</td>
                    <td class="order-details-right-col">{{$order->pickup_point}}</td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-return-flight-no" class="order-details-left-col">{{__('mail_return_flight_no')}}</td>
                    <td class="order-details-right-col">{{$order->return_flight_no}}</td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-return-terminal" class="order-details-left-col">{{__('mail_return_terminal')}}</td>
                    <td class="order-details-right-col">{{$order->getReturnTerminal->name}}</td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-return-notes" class="order-details-left-col">{{__('mail_return_transfer_notes')}}</td>
                    <td class="order-details-right-col">{{$order->return_transfer_notes}}</td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-payment-method" class="order-details-left-col">{{__('mail_payment_method')}}</td>
                    <td id="order-details-payment-method-value" class="order-details-right-col">{{__('mail_default_payment_method')}}</td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-transfer-price" class="order-details-left-col">{{__('mail_transfer_price')}}</td>
                    <td id="order-details-transfer-price-value" class="order-details-right-col">
                        {{number_format($order->converted_price, 2) . ' '}}
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
