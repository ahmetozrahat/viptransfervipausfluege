@extends('admin_email')
@section('content')
    <!-- Page Title -->
    <h3 class="title">Vip Transfer Vip Ausflüge</h3>
    <h3>Kontakt Formular</h3>

    <br><br>
    <h3 class="title">Detail</h3>
    <table class="details-table">
        <tbody>
        <tr>
            <td class="details-row-title">Name Nachname</td>
            <td class="details-row-value">{{$ticket->name}}</td>
        </tr>
        <tr>
            <td class="details-row-title">E-Mail</td>
            <td class="details-row-value">{{$ticket->email}}</td>
        </tr>
        <tr>
            <td class="details-row-title">Telefon Nr.</td>
            <td class="details-row-value">{{$ticket->phone}}</td>
        </tr>
        <tr>
            <td class="details-row-title">Ichre Nachricht</td>
            <td class="details-row-value">{{$ticket->message}}</td>
        </tr>
        </tbody>
    </table>
@endsection
