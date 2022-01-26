/* Global Variables */

/* Import Libraries */
import 'js-loading-overlay';
import cookies from 'js-cookie';
import {Loader} from "@googlemaps/js-api-loader";

/* Object Declaration */
const loader = new Loader({
    apiKey: "AIzaSyBDpCIRvXdsdbsRi1gkBnCNO_CRzEC9AZc",
    version: "weekly"
});

const apiURL = 'https://api.exchangerate-api.com/v4/latest/EUR';

/* DOM Objects */

const vehicleTransferPrice = $(".vehicle-transfer-price");

$(function () {
    retrieveCurrencyFromCookies();

    initMap();
});

/*// Loading the google maps.
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
}*/

/**
 * Function for retrieving the currency data from cookies.
 */
function retrieveCurrencyFromCookies() {
    if (cookies.get('currency') !== undefined && cookies.get('currency') !== null) {
        let currency = cookies.get('currency');
        convertPrices(currency)
    }else {
        cookies.set('currency', 'eur');
        convertPrices('eur');
    }
}

/**
 * Function for formatting the fields with
 * 2 decimal places with a given currency.
 *
 * It will fetch the most recent rates from an api
 * and convert it from EUR.
 *
 * @see https://api.exchangerate-api.com/v4/latest/EUR
 * @param {String} currency tl, usd or eur
 */
function convertPrices(currency) {
    showLoadingOverlay();
    $.ajax({
        type: 'GET',
        url: apiURL,
        success: function (data) {
            hideLoadingOverlay();
            const tl = data.rates.TRY;
            const usd = data.rates.USD;

            switch (currency) {
                case 'tl':
                    // Convert it to TRY if possible.
                    // Fallback to EUR if not possible.
                    if (tl !== undefined && tl !== null)
                        formatFields(tl, '₺');
                    else
                        formatFields(1, '€');
                    break;
                case 'usd':
                    // Convert it to USD if possible.
                    // Fallback to EUR if not possible.
                    if (usd !== undefined && usd !== null)
                        formatFields(usd, '$');
                    else
                        formatFields(1, '€');
                    break;
                case 'eur':
                    formatFields(1, '€');
                    break;
                default:
                    formatFields(1, '€');
                    break;
            }
        },
        error: function (error) {
            hideLoadingOverlay();
            console.log(error);
            formatFields(1, '€');
        }
    });
}

/**
 *
 * Function for formatting the page with the given currency values.
 * It will multiply the default Euro values with currency value against Euro.
 * It will change the € symbol with the given char.
 *
 * @param {Number} multiplier Currency value against the default currency (Euro)
 * @param {String} char Char for the currency that is going to be set.
 */
function formatFields(multiplier, char) {
    let oldPrice = parseFloat(vehicleTransferPrice.attr('price'));
    let newPrice = oldPrice * multiplier;
    let priceString = newPrice.toFixed(2);
    let sliced = priceString.split('.');

    vehicleTransferPrice.html(char + '<strong> ' + sliced[0] + '</strong><sup>.' + sliced[1] + '</sup>');
}

/**
 * Function for showing a spinning wheel in the center
 * on the screen, indicating that some works are in progress.
 */
function showLoadingOverlay() {
    JsLoadingOverlay.show({
        "overlayBackgroundColor": "#666666",
        "overlayOpacity": "0.8",
        "spinnerIcon": "ball-spin-clockwise",
        "spinnerColor": "#78C4D4",
        "spinnerSize": "3x",
        "overlayIDName": "asd",
        "spinnerIDName": "spinner",
        "offsetX": 0,
        "offsetY": 0,
        "containerID": null,
        "lockScroll": true,
        "overlayZIndex": 9998,
        "spinnerZIndex": 9999
    });
}

/**
 * Function for hiding the loading overlay.
 */
function hideLoadingOverlay() {
    JsLoadingOverlay.hide();
}

/**
 * Function for initializing the Google Maps object.
 */
function initMap() {
    loader.load().then(() => {
        let map = new google.maps.Map(document.getElementById("transfers-map"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 8,
        });
    });
}
