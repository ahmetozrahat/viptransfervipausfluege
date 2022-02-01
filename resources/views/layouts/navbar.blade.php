<nav class="navbar navbar-expand-md navbar-dark bg-light">
    <div class="container-fluid nav-container">
        <a class="navbar-brand" href="{{ route('home', app()->getLocale()) }}"><img src="{{asset('img/logo.svg')}}" alt=""
                width="250" height="70"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a id="nav-link-home" class="nav-link active" aria-current="page"
                        href="{{ route('home', app()->getLocale()) }}">{{ __('navbar_home') }}</a>
                </li>
                <li class="nav-item">
                    <a id="nav-link-aboutus" class="nav-link"
                        href="{{ route('aboutus', app()->getLocale()) }}">{{ __('navbar_aboutus') }}</a>
                </li>
                <li class="nav-item">
                    <a id="nav-link-orders" class="nav-link"
                        href="{{ route('myorder', app()->getLocale()) }}">{{ __('navbar_orders') }}</a>
                </li>
                <li class="nav-item">
                    <a id="nav-link-contact" class="nav-link"
                        href="{{ route('contact', app()->getLocale()) }}">{{ __('navbar_contact') }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="nav-link-locale" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('navbar_locale') }}
                    </a>
                    <ul class="dropdown-menu" id="navbarDropdownLocale" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('home', 'tr') }}">Türkçe</a></li>
                        <li><a class="dropdown-item" href="{{ route('home', 'en') }}">English</a></li>
                        <li><a class="dropdown-item" href="{{ route('home', 'de') }}">Deutsch</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a id="nav-link-currency" class="nav-link dropdown-toggle" href="#" id="navbarDropdownCurrency"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('navbar_currency') }}
                    </a>
                    <ul class="dropdown-menu" id="navbarDropdownCurrency" aria-labelledby="navbarDropdown">
                        <li><a id="currency_tl" class="dropdown-item" href="#">₺
                                TRY</a>
                        </li>
                        <li><a id="currency_usd" class="dropdown-item" href="#">$ USD</a></li>
                        <li><a id="currency_eur" class="dropdown-item" href="#">€ EUR</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
