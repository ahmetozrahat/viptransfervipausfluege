$(function () {
    setupCurrency();

    initMap();

    calcRoute();
});

// Loading the google maps.
function initMap() {
    let directionsService = new google.maps.DirectionsService();
    let directionsRenderer = new google.maps.DirectionsRenderer();
    var biz = new google.maps.LatLng(36.879077786388414, 30.709195358313295);
    var mapOptions = {
        zoom: 7,
        center: biz
    }
    var map = new google.maps.Map(document.getElementById('transfers-map'), mapOptions);
    directionsRenderer.setMap(map);
}

function calcRoute() {
    let str = $("#transfer-page-title").html().split('<br>');

    var start = str[0];
    var end = str[1];
    var request = {
        origin: start,
        destination: end,
        travelMode: 'DRIVING'
    };
    directionsService.route(request, function (result, status) {
        if (status == 'OK') {
            directionsRenderer.setDirections(result);
        }
    });
}

function formatFields(multiplier, char) {
    let price = (parseFloat($(".vehicle-transfer-price").html()) * multiplier).toFixed(2);
    let sliced = price.split('.');
    $(".vehicle-transfer-price").html(char + '<strong> ' + sliced[0] + '</strong><sup>.' + sliced[1] + '</sup>');
}

function setupCurrency() {
    $.ajax({
        url: "v1/getCurrency.php",
        type: "post",
        success: function (response) {
            if (response !== false && response !== undefined) {
                let data = JSON.parse(response);

                let tl = data[0]['tl'];
                let usd = data[0]['usd'];

                switch (currency) {
                    case 'tl':
                        formatFields(tl, '₺');
                        break;
                    case 'usd':
                        formatFields(usd, '$');
                        break;
                    case 'eur':
                        formatFields(1, '€');
                        break;
                    default:
                        formatFields(1, '€');
                        break;
                }
            }

            initMap();
            calcRoute();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            formatFields(1, '€');
        }
    });
}
