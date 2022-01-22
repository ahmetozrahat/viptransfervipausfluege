$(function () {
    $("#navbarDropdownCurrency a").on('click', function () {
        if ($(this).attr('id') === 'currency_tl') {
            document.cookie = "currency=tl";
        } else if ($(this).attr('id') === 'currency_usd') {
            document.cookie = "currency=usd";
        } else if ($(this).attr('id') === 'currency_eur') {
            document.cookie = "currency=eur";
        } else {
            document.cookie = "currency=eur";
        }

        location.reload();
    });
})
