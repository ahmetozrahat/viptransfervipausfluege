<footer>
    <div class="container-fluid footer-container">
        <div class="row">
            <div class="col-md-3 footer-col">
                <div id="footer-section-title1" class="footer-section title">{{ __('footer_section_title1') }}</div>
                <div id="footer-section-text1" class="footer-section desc footer-block">
                    {{ __('footer_section_text1') }}
                </div>
                <a class="fab fa-facebook-f footer-icn" href="{{$contact->facebook}}" target="_blank"></a>
                <a class="fab fa-instagram footer-icn" href="{{$contact->instagram}}" target="_blank"></a>
            </div>
            <div class="col-md-6 footer-col">
                <div id="footer-section-title2" class="footer-section title">{{ __('footer_section_title2') }}</div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 footer-block">
                            <ul>
                                <li>
                                    <a id="footer-section-link1" class="footer-list-item"
                                        href="{{ route('home', app()->getLocale()) }}">{{ __('footer_section_link1') }}</a>
                                </li>
                                <li>
                                    <a id="footer-section-link2" class="footer-list-item"
                                        href="{{ route('aboutus', app()->getLocale()) }}">{{ __('footer_section_link2') }}</a>
                                </li>
                                <li>
                                    <a id="footer-section-link3" class="footer-list-item"
                                        href="#">{{ __('footer_section_link3') }}</a>
                                </li>
                                <li>
                                    <a id="footer-section-link4" class="footer-list-item"
                                        href="{{ route('myorder', app()->getLocale()) }}">{{ __('footer_section_link4') }}</a>
                                </li>
                                <li>
                                    <a id="footer-section-link5" class="footer-list-item"
                                        href="{{ route('contact', app()->getLocale()) }}">{{ __('footer_section_link5') }}</a>
                                </li>
                                <li>
                                    <a id="footer-section-link6" class="footer-list-item"
                                        href="#">{{ __('footer_section_link6') }}</a>
                                </li>
                                <li>
                                    <a id="footer-section-link7" class="footer-list-item"
                                        href="#">{{ __('footer_section_link7') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-sm-6 footer-block">
                            <ul>
                                <li>
                                    <a id="footer-section-link8" class="footer-list-item"
                                        href="#">{{ __('footer_section_link8') }}</a>
                                </li>
                                <li>
                                    <a id="footer-section-link9" class="footer-list-item"
                                        href="#">{{ __('footer_section_link9') }}</a>
                                </li>
                                <li>
                                    <a id="footer-section-link10" class="footer-list-item"
                                        href="#">{{ __('footer_section_link10') }}</a>
                                </li>
                                <li>
                                    <a id="footer-section-link11" class="footer-list-item"
                                        href="#">{{ __('footer_section_link11') }}</a>
                                </li>
                                <li>
                                    <a id="footer-section-link12" class="footer-list-item"
                                        href="#">{{ __('footer_section_link12') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 footer-col">
                <div id="footer-section-title3" class="footer-section title">{{ __('footer_section_title3') }}</div>
                <div class="footer-block">
                    <div class="footer-contact-item">
                        <div class="footer-contact-item">
                            <i class="fas fa-phone footer-icn-small"></i>
                            <a class="footer-list-item" href="tel:{{$contact->company_phone}}">T: {{$contact->company_phone}}</a>
                        </div>
                        <div class=" footer-contact-item">
                            <i class="fas fa-envelope footer-icn-small"></i>
                            <a class="footer-list-item" href="mailto:{{$contact->company_email}}">E:
                                {{$contact->company_email}}</a>
                        </div>
                        <div class="footer-contact-item">
                            <i class="fas fa-map-marker-alt footer-icn-small"></i>
                            <a class="footer-list-item" href="{{$contact->maps_url}}" target="_blank">{{$contact->company_address}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="footer-banner">
    <div class="footer-banner-company">
        Powered by
        <a class="footer-company-url" href="https://noa.com">NOA Software</a>
    </div>
    <div class="footer-banner-copyright">
        {{ __('') }}Copyright &copy; 2021 Vip Transfer Vip Ausfluege. İzinsiz Kopyalanamaz. Bütün
        Hakkı Saklıdır
    </div>
</div>

<!-- Floating WhatsApp Button -->
<a href="https://api.whatsapp.com/send?phone={{$contact->company_phone}}&text=Merhaba!" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
</a>
