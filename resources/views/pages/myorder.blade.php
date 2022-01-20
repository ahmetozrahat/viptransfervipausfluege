@extends('main')
@section('content')
    <!-- Page Header Section -->
    <div class="page-header about-us">
        <div id="myorder-page-title" class="page-title">
            TRANSFER SİPARİŞİM
        </div>
    </div>

    <!-- Order Section -->
    <div class="myorder-form">
        <div id="myorder-page-desc" class="page-desc">
            Transfer siparişinizi düzenlemek için lütfen alttaki bölüme sipariş numaranızı ve sipariş esnasında
            kullandığınız e-mail adresinizi giriniz ve <strong>SORGULA </strong> butonuna basınız.
        </div>
        <div class="myorder-section">
            <form id="myorder-form" action="#" method="POST">
                <div class="container-fluid">
                    <div class="row">
                        <div id="booking-col-1" class="col-md-4 booking">
                            <input id="myorder-input1" class="form-control form-control-lg myorder-input" type="text"
                                name="id" placeholder="Sipariş No" aria-label=".form-control-lg example" required>
                        </div>
                        <div id="booking-col-2" class="col-md-4 booking">
                            <input id="myorder-input2" class="form-control form-control-lg myorder-input" type="email"
                                name="email" placeholder="E-Mail" aria-label=".form-control-lg example" required>
                        </div>
                        <div id="booking-col-6" class="col-md-4 booking">
                            <div class="d-grid gap-2">
                                <button id="myorder-input3" type="submit" class="btn btn-dark btn-lg">
                                    SORGULA
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="js/myorder1.0.5.js"></script>
    <script src="js/toast/jquery.toast.min.js"></script>
@endsection
