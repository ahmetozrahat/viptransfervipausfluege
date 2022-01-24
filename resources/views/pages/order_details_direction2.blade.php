@extends('main')
@section('content')
    <!-- Page Header Section -->
    <div class="page-header about-us">
        <div id="order-created-page-title" class="page-title" style="text-align: left;">
            SİPARİŞ DETAYI
        </div>
    </div>

    <!-- Order Details Section -->
    <div class="order-details">
        <input type="hidden" name="order-id" id="order-id-input" value="">
        <input type="hidden" name="order-email" id="order-email-input" value="">

        <i class="fas fa-check-circle order-success"></i>
        <div id="order-success-title" class="order-success-title">{{__('mail_order_placed')}}</div>
        <div id="order-id" class="order-id">{{__('mail_order_id', ['id' => $order->order_id])}}</div>
        <div id="order-details" class="order-details">
            Sipariş detaylarının bir nüshası <strong></strong> adresine gönderilmiştir. Bizi tercih ettiğiniz için teşekkür ederiz.
        </div>
        <div class="order-details-table-section">
            <input id="transfer-direction-value" type="hidden" value=""/>
            <table class="order-details-table">
                <tbody>
                <tr class="order-details-row">
                    <td id="order-details-name" class="order-details-left-col">{{__('mail_name')}}</td>
                    <td class="order-details-right-col">{{$order->name}}</td>
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
                    <td id="order-details-payment-method" class="order-details-left-col">{{__('mail_payment_method')}}</td>
                    <td id="order-details-payment-method-value" class="order-details-right-col">{{__('mail_default_payment_method')}}</td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-transfer-price" class="order-details-left-col">{{__('mail_transfer_price')}}</td>
                    <td id="order-details-transfer-price-value" class="order-details-right-col">
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
