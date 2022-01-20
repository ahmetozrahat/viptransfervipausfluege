@extends('main')
@section('content')
    <!-- Carousel Section -->
    <div class="carousel-container">
        <h1 id="carousel-title" class="heading-text"><strong>BİZİ TERCİH</strong> ETTİLER</h1>

        <div class="container-fluid">
            <div id="carouselExampleControls" class="carousel slide carousel-customers" data-bs-ride="carousel">
                <div class="carousel-inner">
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
        <div id="booking-title" class="booking-title">HEMEN TRANSFER SİPARİŞİ VER</div>
        <form action="transfer.php" method="POST">
            <div class="container-fluid">
                <div class="row">
                    <div id="booking-col-1" class="col-md-4 booking">
                        <select class="form-control form-control-lg booking-icn direction" name="booking-transfer-direction"
                            id="booking-select-transfer-direction" required>
                            <option id="booking-col1-option1" value="" disabled selected>Transfer Yönü</option>
                            <option id="booking-col1-option2" value="1">Çift Yön</option>
                            <option id="booking-col1-option3" value="2">Havalimanından Hotele/Noktaya</option>
                            <option id="booking-col1-option4" value="3">Hotelden/Noktadan Havalimanına</option>
                        </select>
                    </div>
                    <div id="booking-col-2" class="col-md-4 booking">
                        <input type="hidden" id="airport-name" name="airport-name" value="">
                        <select class="form-control form-control-lg booking-icn airport" name="booking-airport"
                            id="booking-select-airport-col2">
                            <option id="booking-col2-option1" value="" disabled selected>Havaalanı</option>
                        </select>
                        <select class="form-control form-control-lg booking-icn transfer-point"
                            name="booking-transfer-point" id="booking-select-transfer-point-col2">
                            <option value="" disabled selected>Transfer Noktası</option>
                        </select>
                    </div>
                    <div id="booking-col-3" class="col-md-4 booking">
                        <input type="hidden" id="transfer-point-name" name="transfer-point-name" value="">
                        <select class="form-control form-control-lg booking-icn transfer-point"
                            name="booking-transfer-point" id="booking-select-transfer-point-col3">
                            <option id="booking-col3-option1" value="" disabled selected>Transfer Noktası</option>
                        </select>
                        <select class="form-control form-control-lg booking-icn airport" name="booking-airport"
                            id="booking-select-airport-col3">
                            <option value="" disabled selected>Havaalanı</option>
                        </select>
                    </div>
                    <div id="booking-col-4" class="col-md-4 booking">
                        <div class="form-control form-control-lg booking-icn passengers" id="booking-select-passengers"
                            style="text-align: left;">
                            <div id="passengers-count" class="noselect">
                                Yolcular
                            </div>
                        </div>
                        <div id="passenger-dropdown" class="passenger-dropdown">
                            <div class="form-group">
                                <label id="passengers-adult-label" class="passenger-label">Yetişkin Sayısı</label>
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
                                <label id="passengers-kid-label" class="passenger-label">Çocuk (2-11 Yaş)</label>
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
                                <label id="passengers-baby-label" class="passenger-label">Bebek (0-2 Yaş)</label>
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
                                        DEVAMI
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="booking-col-5" class="col-md-4 booking">
                        <select class="form-control form-control-lg booking-icn baby-seat" name="passenger-baby-seat"
                            id="passenger-select-baby-seat" required>
                            <option id="booking-col5-option1" value="" disabled selected>Bebek/Çocuk Koltuğu</option>
                        </select>
                    </div>
                    <div id="booking-col-6" class="col-md-4 booking">
                        <div class="d-grid gap-2">
                            <button id="booking-search-button" type="submit" class="btn btn-dark btn-lg">
                                TRANSFER ARA
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
                <strong>MÜŞTERİ</strong> YORUMLARI
            </h1>
            <div id="carouselExampleCaptions" class="carousel slide carousel-testimonial" data-bs-ride="carousel"
                data-bs-pause="false">
                <div class="carousel-inner">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="js/bootstrap-input-spinner.js"></script>
    <script src="js/language1.0.5.js"></script>
    <script src="js/main1.0.5.js"></script>
@endsection
