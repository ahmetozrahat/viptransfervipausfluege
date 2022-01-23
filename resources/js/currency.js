import cookies from 'js-cookie';

$(function () {
    $("#navbarDropdownCurrency a").on('click', function () {
        let cookie = $(this).attr('id');
        switch (cookie) {
            case 'currency_tl':
                cookies.set('currency', 'tl');
                break;
            case 'currency_usd':
                cookies.set('currency', 'usd');
                break;
            case 'currency_eur':
                cookies.set('currency', 'eur');
                break;
            default:
                cookies.set('currency', 'eur');
                break;
        }
        location.reload();
    });
})
