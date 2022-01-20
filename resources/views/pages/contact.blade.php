@extends('main')
@section('content')
    <!-- Toasts -->
    <div id="success-toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: -1">
        <div id="success-toast" class="toast" auto role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-check-circle toast-icn-success"></i>
                <strong id="success-toast-title" class="me-auto">Bilgi</strong>
                <small id="success-toast-date">az önce</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div id="success-toast-body" class="toast-body">
                İletişim talebiniz başarı ile alındı.
            </div>
        </div>
    </div>

    <div id="failure-toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: -1">
        <div id="failure-toast" class="toast" auto role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-times-circle toast-icn-failure"></i>
                <strong id="failure-toast-title" class="me-auto">Hata</strong>
                <small id="failure-toast-date">az önce</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div id="failure-toast-body" class="toast-body">
                İletişim talebiniz alınırken bir sorun oluştu.
            </div>
        </div>
    </div>

    <!-- Page Header Section -->
    <div class="page-header about-us">
        <div id="contact-page-title" class="page-title">
            İLETİŞİM
        </div>
    </div>

    <div id="contact-info-section" class="container-fluid contact-section">
        <div id="contact-section-title" class="contact-title">
            İLETİŞİM BİLGİLERİ
        </div>
        <div class="row">
            <div class="col-md-6 contact-box">
                <span class="contact-box-icon icon-company"></span>
                <div id="contact-box-title1" class="contact-box-title"><em>Şirket Adı:</em></div>
                <div class="contact-box-desc">Vip Ausfluege Transfer Turizm Ticaret Pazarlama Limited Şirket</div>
            </div>
            <div class="col-md-6 contact-box">
                <span class="contact-box-icon icon-email"></span>
                <div id="contact-box-title2" class="contact-box-title"><em>E-Mail:</em></div>
                <div class="contact-box-desc">info@viptransfervipausfluege.com</div>
            </div>
            <div class="col-md-6 contact-box">
                <span class="contact-box-icon icon-address"></span>
                <div id="contact-box-title3" class="contact-box-title"><em>Adres:</em></div>
                <div class="contact-box-desc">Kemerağzı Mah. Yaşar Sabutay Blv. Karnas iş Mrk. No: 14/13 Aksu/ Antalya</div>
            </div>
            <div class="col-md-6 contact-box">
                <span class="contact-box-icon icon-call-center"></span>
                <div id="contact-box-title4" class="contact-box-title"><em>Çağrı Merkezi:</em></div>
                <div class="contact-box-desc">+90 544 170 07 38</div>
            </div>
        </div>
    </div>

    <!--The div element for the map -->
    <div class="contact-map-container">
        <form action="#" id="contact-form" class="contact-map-form">
            <h2 id="contact-form-title" class="map-form-title">İLETİŞİM FORMU</h2>
            <input type="name" class="form-control map-form-input" id="contact-form-name" name="name"
                placeholder="Adınız Soyadınız" required>
            <input type="email" class="form-control map-form-input" id="contact-form-email" name="email"
                placeholder="E-Mail" required>
            <input type="tel" class="form-control map-form-input" id="contact-form-phone" name="phone"
                placeholder="Telefon No." required>
            <textarea type="text" class="form-control map-form-input" id="contact-form-message" name="message"
                placeholder="Mesajınız" required></textarea>
            <div class="d-grid gap-2">
                <button id="contact-form-submit" type="submit" class="btn btn-dark btn-lg">GÖNDER</button>
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
    <script src="js/contact1.0.5.js"></script>
@endsection
