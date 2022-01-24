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
        <div id="order-success-title" class="order-success-title">Siparişiniz Alındı</div>
        <div id="order-id" class="order-id">Sipariş No #</div>
        <div id="order-details" class="order-details">
            Sipariş detaylarının bir nüshası <strong></strong> adresine gönderilmiştir. Bizi tercih ettiğiniz için teşekkür ederiz.
        </div>
        <div class="order-details-table-section">
            <input id="transfer-direction-value" type="hidden" value=""/>
            <table class="order-details-table">
                <tbody>
                <tr class="order-details-row">
                    <td id="order-details-name" class="order-details-left-col">%name_title%</td>
                    <td class="order-details-right-col"></td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-land-date" class="order-details-left-col">%land_date_title%</td>
                    <td class="order-details-right-col"></td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-transfer-point" class="order-details-left-col">%transfer_point_title%</td>
                    <td class="order-details-right-col"></td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-flight-no" class="order-details-left-col">%flight_no_title%</td>
                    <td class="order-details-right-col"></td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-terminal" class="order-details-left-col">%terminal_title%</td>
                    <td class="order-details-right-col"></td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-notes" class="order-details-left-col">%notes_title%</td>
                    <td class="order-details-right-col"></td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-payment-method" class="order-details-left-col">%payment_method_title%</td>
                    <td id="order-details-payment-method-value" class="order-details-right-col"></td>
                </tr>
                <tr class="order-details-row">
                    <td id="order-details-transfer-price" class="order-details-left-col">%price_title%</td>
                    <td id="order-details-transfer-price-value" class="order-details-right-col"></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
