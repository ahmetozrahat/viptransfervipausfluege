@extends('main')
@section('title')
    {{__('tab_title_home', ['company' => 'VipTransferVipAusfluege'])}}
@endsection
@section('content')
    <meta name="_token" content="{{ csrf_token() }}" />
    <meta name="airport-translation" content="{{ __('booking_section_col2') }}" />
    <meta name="transfer-point-translation" content="{{ __('booking_section_col3') }}" />
    <!-- Carousel Section -->
    <div class="carousel-container">
        <h1 id="carousel-title" class="heading-text">{!! __('carousel_section_title') !!}</h1>

        <div class="container-fluid">
            <div id="carouselExampleControls" class="carousel slide carousel-customers" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($mainSlider as $row)
                        <div class="carousel-item @if ($loop->first) active @endif">
                            <img class="d-block w-100" src="{{ $row->image_url }}" alt=" Slide {{ $loop->index }}">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Booking Section -->
    <div class="booking-section">
        <div id="booking-title" class="booking-title">{{ __('booking_section_title') }}</div>
        <form action="{{route('transfer', app()->getLocale())}}" method="POST">
            @csrf
            <div class="container-fluid">
                <div class="row">
                    <div id="booking-col-1" class="col-md-4 booking">
                        <select class="form-control form-control-lg booking-icn direction" name="booking-transfer-direction"
                            id="booking-select-transfer-direction" required>
                            <option id="booking-col1-option1" value="" disabled selected>
                                {{ __('booking_section_col1') }}
                            </option>
                            <option id="booking-col1-option2" value="1">
                                {{ __('booking_section_col1_option1') }}</option>
                            <option id="booking-col1-option3" value="2">
                                {{ __('booking_section_col1_option2') }}</option>
                            <option id="booking-col1-option4" value="3">
                                {{ __('booking_section_col1_option3') }}</option>
                        </select>
                    </div>
                    <div id="booking-col-2" class="col-md-4 booking">
                        <input type="hidden" id="airport-name" name="airport-name" value="">
                        <select class="form-control form-control-lg booking-icn airport" name="booking-airport"
                            id="booking-select-airport-col2">
                            <option id="booking-col2-option1" value="" disabled selected>
                                {{ __('booking_section_col2') }}
                            </option>
                        </select>
                        <select class="form-control form-control-lg booking-icn transfer-point"
                            name="booking-transfer-point" id="booking-select-transfer-point-col2">
                            <option value="" disabled selected>{{ __('booking_section_col3') }}
                            </option>
                        </select>
                    </div>
                    <div id="booking-col-3" class="col-md-4 booking">
                        <input type="hidden" id="transfer-point-name" name="transfer-point-name" value="">
                        <select class="form-control form-control-lg booking-icn transfer-point"
                            name="booking-transfer-point" id="booking-select-transfer-point-col3">
                            <option id="booking-col3-option1" value="" disabled selected>
                                {{ __('booking_section_col3') }}
                            </option>
                        </select>
                        <select class="form-control form-control-lg booking-icn airport" name="booking-airport"
                            id="booking-select-airport-col3">
                            <option value="" disabled selected>{{ __('booking_section_col2') }}
                            </option>
                        </select>
                    </div>
                    <div id="booking-col-4" class="col-md-4 booking">
                        <div class="form-control form-control-lg booking-icn passengers" id="booking-select-passengers"
                            style="text-align: left;">
                            <div id="passengers-count" class="noselect">
                                {{ __('booking_section_col4') }}
                            </div>
                        </div>
                        <div id="passenger-dropdown" class="passenger-dropdown">
                            <div class="form-group">
                                <label id="passengers-adult-label"
                                    class="passenger-label">{{ __('passengers_adult_label') }}</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button id="btn-decrement-adult-quantity" type="button"
                                            class="btn btn-primary stepper-btn">-</button>
                                    </span>
                                    <input readonly="" id="passenger-adult-quantity" name="passenger-adult-quantity"
                                        class="form-control" type="text" value="1" min="1" style="text-align: center;">
                                    <span class="input-group-btn">
                                        <button id="btn-increment-adult-quantity" type="button"
                                            class="btn btn-primary stepper-btn">+</button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label id="passengers-kid-label"
                                    class="passenger-label">{{ __('passengers_kid_label') }}</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button id="btn-decrement-kid-quantity" type="button"
                                            class="btn btn-primary stepper-btn">-</button>
                                    </span>
                                    <input readonly="" id="passenger-kid-quantity" name="passenger-kid-quantity"
                                        class="form-control" type="text" value="0" min="0" style="text-align: center;">
                                    <span class="input-group-btn">
                                        <button id="btn-increment-kid-quantity" type="button"
                                            class="btn btn-primary stepper-btn">+</button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label id="passengers-baby-label"
                                    class="passenger-label">{{ __('passengers_baby_label') }}</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button id="btn-decrement-baby-quantity" type="button"
                                            class="btn btn-primary stepper-btn">-</button>
                                    </span>
                                    <input readonly="" id="passenger-baby-quantity" name="passenger-baby-quantity"
                                        class="form-control" type="text" value="0" min="0" style="text-align: center;">
                                    <span class="input-group-btn">
                                        <button id="btn-increment-baby-quantity" type="button"
                                            class="btn btn-primary stepper-btn">+</button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-grid gap-2 input-group">
                                    <button id="passenger-quantity-submit" type="button" class="btn btn-dark">
                                        {{ __('passengers_seat_submit') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="booking-col-5" class="col-md-4 booking">
                        <select class="form-control form-control-lg booking-icn baby-seat" name="passenger-baby-seat"
                            id="passenger-select-baby-seat" required>
                            <option id="booking-col5-option1" value="" disabled selected>
                                {{ __('booking_section_col5') }}
                            </option>
                            @for ($i = 0; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div id="booking-col-6" class="col-md-4 booking">
                        <div class="d-grid gap-2">
                            <button id="booking-search-button" type="submit" class="btn btn-dark btn-lg">
                                {{ __('booking_search_button') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Testimonials Section -->
    <div class="testimonial-container">
        <div class="testimonial-tint">
            <h1 id="testimonials-title" class="heading-text testimonial-header">
                {!! __('testimonials_section_title') !!}
            </h1>
            <div id="carouselExampleCaptions" class="carousel slide carousel-testimonial" data-bs-ride="carousel"
                data-bs-pause="false">
                <div class="carousel-inner">
                    @foreach ($userReviews as $review)
                        <div class="carousel-item @if ($loop->first) active @endif">
                            <div class="testimonial-comment">
                                {{ $review->comment }}
                            </div>

                            @for ($i = 1; $i <= 5; $i++)
                                @if ($review->rating >= $i)
                                    <i class="fas fa-star testimonial-star"></i>
                                @else
                                    <i class="far fa-star testimonial-star"></i>
                                @endif
                            @endfor
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ mix('js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
