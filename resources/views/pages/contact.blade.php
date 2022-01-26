@extends('main')
@section('content')
    <meta name="_token" content="{{ csrf_token() }}" />
    <!-- Page Header Section -->
    <div class="page-header about-us">
        <div id="contact-page-title" class="page-title">
            {{ __('contact_page_title') }}
        </div>
    </div>

    <div id="contact-info-section" class="container-fluid contact-section">
        <div id="contact-section-title" class="contact-title">
            {{ __('contact_section_title') }}
        </div>
        <div class="row">
            <div class="col-md-6 contact-box">
                <span class="contact-box-icon icon-company"></span>
                <div id="contact-box-title1" class="contact-box-title">{!! __('contact_box_title1') !!}</div>
                <div class="contact-box-desc">{{$contact->company_name}}</div>
            </div>
            <div class="col-md-6 contact-box">
                <span class="contact-box-icon icon-email"></span>
                <div id="contact-box-title2" class="contact-box-title">{!! __('contact_box_title2') !!}</div>
                <div class="contact-box-desc">{{$contact->company_email}}</div>
            </div>
            <div class="col-md-6 contact-box">
                <span class="contact-box-icon icon-address"></span>
                <div id="contact-box-title3" class="contact-box-title">{!! __('contact_box_title3') !!}</div>
                <div class="contact-box-desc">{{$contact->company_address}}</div>
            </div>
            <div class="col-md-6 contact-box">
                <span class="contact-box-icon icon-call-center"></span>
                <div id="contact-box-title4" class="contact-box-title">{!! __('contact_box_title4') !!}</div>
                <div class="contact-box-desc">{{$contact->company_phone}}</div>
            </div>
        </div>
    </div>

    <!--The div element for the map -->
    <div class="contact-map-container">
        <form action="#" id="contact-form" class="contact-map-form">
            @csrf
            <h2 id="contact-form-title" class="map-form-title">{{ __('contact_form_title') }}</h2>
            <input type="name" class="form-control map-form-input" id="contact-form-name" name="name"
                placeholder="{{ __('contact_form_name') }}" required>
            <input type="email" class="form-control map-form-input" id="contact-form-email" name="email"
                placeholder="{{ __('contact_form_email') }}" required>
            <input type="tel" class="form-control map-form-input" id="contact-form-phone" name="phone"
                placeholder="{{ __('contact_form_phone') }}" required>
            <textarea type="text" class="form-control map-form-input" id="contact-form-message" name="message"
                placeholder="{{ __('contact_form_message') }}" required></textarea>
            <div class="d-grid gap-2">
                <button id="contact-form-submit" type="submit"
                    class="btn btn-dark btn-lg">{{ __('contact_form_submit') }}</button>
            </div>
        </form>
        <div id="contact-map"></div>
    </div>
@endsection
@section('scripts')
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDpCIRvXdsdbsRi1gkBnCNO_CRzEC9AZc&callback=initMap&libraries=&v=weekly"
        async></script>
    <script src="{{ mix('js/contact.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection
