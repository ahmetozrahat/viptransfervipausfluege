@extends('main')
@section('content')
    <meta name="person_capacity" content="{{__('')}}">
    <!-- Page Header Section -->
    <div class="page-header about-us">
        <div id="transfer-page-title" class="page-title" style="text-align: left;">
            {{$formData['airport-name']}}
            <br>
            {{$formData['transfer-point-name']}}
        </div>
    </div>

    <!-- Vehicles Section -->
    <div class="container-fluid vehicles-section">
        <div class="row">
            @foreach($eligibleTransfers as $transfer)
                <form action="#" method="POST">
                    @csrf
                    <input type="hidden" name="direction" value="{{$transfer['direction']}}">
                    <input type="hidden" name="airport" value="{{$transfer['airport']}}">
                    <input type="hidden" name="airportName" value="{{$transfer['airportName']}}">
                    <input type="hidden" name="transferPoint" value="{{$transfer['transferPoint']}}">
                    <input type="hidden" name="transferPointName" value="{{$transfer['transferPointName']}}">
                    <input type="hidden" name="adultQuantity" value="{{$transfer['adultQuantity']}}">
                    <input type="hidden" name="kidQuantity" value="{{$transfer['kidQuantity']}}">
                    <input type="hidden" name="babyQuantity" value="{{$transfer['babyQuantity']}}">
                    <input type="hidden" name="babySeat" value="{{$transfer['babySeat']}}">
                    <input type="hidden" name="region" value="{{$transfer['region']}}">
                    <input type="hidden" name="vehicle" value="{{$transfer['vehicle']->id}}">
                    <input type="hidden" name="vehicleName" value="{{$transfer['vehicle']->name}}">
                    <input type="hidden" name="price" value="{{$transfer['price']}}">
                    <div class="col-lg-12 vehicle-box">
                        <img class="vehicle-img" src="/img/vehicles/{{$transfer['vehicle']->image}}" alt="vehicle_photo">
                        <div class="vehicle-info-section">
                            <div class="vehicle-title">
                                <strong>Private Auto</strong> <span class="vehicle-title small">{{$transfer['vehicle']->name}}</span>
                            </div>
                            <div class="vehicle-info">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="vehicle-info-row-1"><i class="fas fa-users vehicle-info-icon"></i>{{__('transfer_person_capacity')}}</td>
                                        <td>: 1- {{$transfer['vehicle']->seat_quantity}} <span class="vehicle-info-row-person">Kişi</span></td>
                                    </tr>
                                    <tr>
                                        <td class="vehicle-info-row-2"><i class="fas fa-suitcase vehicle-info-icon"></i>{{__('transfer_luggage_capacity')}}</td>
                                        <td class="vehicle-info-baggage" id="vehicle-info-baggage">: {{$transfer['vehicle']->baggage_quantity}}</td>
                                    </tr>
                                    <tr>
                                        <td class="vehicle-info-row-3"><i class="fas fa-stopwatch vehicle-info-icon"></i>{{__('transfer_duration')}}</td>
                                        <td class="vehicle-info-duration" id="vehicle-info-duration">: {{__('undefined')}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="vehicle-book">
                            <div class="vehicle-book-items">
                                <div class="vehicle-transfer-price">{{$transfer['price']}}</div>
                                <button type="submit" class="btn btn-light vehicle-book-btn">{{__('transfer_book_now')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach
        </div>
    </div>

    <!--The div element for the map -->
    <div class="transfers-map-container">
        <div id="transfers-map"></div>
    </div>
@endsection
@section('scripts')
    <script src="{{ mix('js/transfer.js') }}"></script>
@endsection
