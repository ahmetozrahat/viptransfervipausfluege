@extends('admin_email')
@section('content')
    <table class="details-table">
        <tbody>
        <tr>
            <td class="details-row-title">Reservierungsnummer</td>
            <td class="details-row-value">{{$order->order_id}}</td>
        </tr>
        <tr>
            <td class="details-row-title">Bestelldatum & Uhrzeit</td>
            <td class="details-row-value">{{date('d.m.Y G:i:s', strtotime($order->created_at))}}</td>
        </tr>
        <tr>
            <td class="details-row-title">Fahrzeug</td>
            <td class="details-row-value">{{$order->getVehicle->name}}</td>
        </tr>
        <tr>
            <td class="details-row-title">Original Preis</td>
            <td class="details-row-value">{{$order->original_price . ' €'}}</td>
        </tr>
        <tr>
            <td class="details-row-title">Währungspreis</td>
            <td class="details-row-value">
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
        <tr>
            <td class="details-row-title">Zahlungsart</td>
            <td class="details-row-value">Bar Bezahlung (an den Fahrer)</td>
        </tr>
        </tbody>
    </table>
    <h3 class="title">ANKUNFTS DETAILS</h3>
    <table class="details-table">
        <tbody>
        <tr>
            <td class="details-row-title">Transferrichtung</td>
            <td class="details-row-value">{{$order->getTransferPoint->name}}</td>
        </tr>
        <tr>
            <td class="details-row-title">Passagiere</td>
            <td class="details-row-value">{{$order->passenger_quantity}}</td>
        </tr>
        <tr>
            <td class="details-row-title">Flug Datum & Zeit</td>
            <td class="details-row-value">{{date('d.m.Y G:i:s', strtotime($order->flight_date))}}</td>
        </tr>
        <tr>
            <td class="details-row-title">Flugnummer</td>
            <td class="details-row-value">{{$order->flight_no}}</td>
        </tr>
        <tr>
            <td class="details-row-title">Kinder/Baby Sitz</td>
            <td class="details-row-value">{{$order->baby_seat}}</td>
        </tr>
        <tr>
            <td class="details-row-title">Anmerkungen</td>
            <td class="details-row-value">{{$order->transfer_notes}}</td>
        </tr>
        </tbody>
    </table>
    <h3 class="title">ABREISE DETAILS</h3>
    <table class="details-table">
        <tbody>
        <tr>
            <td class="details-row-title">Transferrichtung</td>
            <td class="details-row-value">{{$order->pickup_point}}</td>
        </tr>
        <tr>
            <td class="details-row-title">Passagiere</td>
            <td class="details-row-value">{{$order->passenger_quantity}}</td>
        </tr>
        <tr>
            <td class="details-row-title">Flug Datum & Zeit</td>
            <td class="details-row-value">{{date('d.m.Y G:i:s', strtotime($order->return_flight_date))}}</td>
        </tr>
        <tr>
            <td class="details-row-title">Transfer Datum & Zeit</td>
            <td class="details-row-value">{{date('d.m.Y G:i:s', strtotime($order->return_transfer_date))}}</td>
        </tr>
        <tr>
            <td class="details-row-title">Flugnummer</td>
            <td class="details-row-value">{{$order->return_flight_no}}</td>
        </tr>
        <tr>
            <td class="details-row-title">Kinder/Baby Sitz</td>
            <td class="details-row-value">{{$order->baby_seat}}</td>
        </tr>
        <tr>
            <td class="details-row-title">Anmerkungen</td>
            <td class="details-row-value">{{$order->return_transfer_notes}}</td>
        </tr>
        </tbody>
    </table>
    <h3 class="title">IHRE PERSÖNLICHEN DATEN</h3>
    <table class="details-table">
        <tbody>
        <tr>
            <td class="details-row-title">Name Nachname</td>
            <td class="details-row-value">{{$order->name}}</td>
        </tr>
        <tr>
            <td class="details-row-title">E-Mail</td>
            <td class="details-row-value">{{$order->email}}</td>
        </tr>
        <tr>
            <td class="details-row-title">Telefon Nr.</td>
            <td class="details-row-value">{{$order->phone}}</td>
        </tr>
        </tbody>
    </table>
@endsection
