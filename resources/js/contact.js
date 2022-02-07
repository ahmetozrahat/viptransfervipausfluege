/* Global Variables */

/* Import Libraries */
import { Loader } from '@googlemaps/js-api-loader';
import 'js-loading-overlay';
import 'toastr';

/* Object Declaration */
const loader = new Loader({
    apiKey: "AIzaSyBDpCIRvXdsdbsRi1gkBnCNO_CRzEC9AZc",
    version: "weekly"
});

/* DOM Models */
const form = $('#contact-form');

const nameInput = $('#contact-form-name');
const emailInput = $('#contact-form-email');
const phoneInput = $('#contact-form-phone');
const messageInput = $('#contact-form-message');

$(function () {
    setupNavbar();

    setupClickListeners();

    initMap();
});

/**
 * Function for coloring the "My Order" tab of the navbar.
 */
function setupNavbar() {
    $("#nav-link-home").attr('class', 'nav-link');
    $("#nav-link-contact").addClass('nav-link active');
}

/**
 * Function for setting up click listeners for DOM objects.
 */
function setupClickListeners() {
    form.submit(function (e) {
        e.preventDefault();

        let data = {
            name: nameInput.val(),
            email: emailInput.val(),
            phone: phoneInput.val(),
            message: messageInput.val(),
            _token: $('meta[name=_token]').attr('content')
        };

        sendContactForm(data);
    });
}

/**
 * Function for creating a contact form.
 *
 * @param {Object} contactData
 */
function sendContactForm(contactData) {
    showLoadingOverlay();
    $.ajax({
        type: 'POST',
        url: '/api/v1/contact-form',
        data: contactData,
        success: function (data) {
            hideLoadingOverlay();
            if (data)
                toastr.success('İletişim talebiniz başarıyla alındı.');
            else
                console.log(data);
        },
        error: function (error) {
            hideLoadingOverlay();
            console.log(error);
            toastr.error('İletişim talebiniz alınırken bir sorun oluştu. Lütfen daha sonra tekrar deneyiniz.');
        }
    });
}

/**
 * Function for initializing the Google Maps object.
 */
function initMap() {
    loader.load().then(() => {
        let map = new google.maps.Map(document.getElementById("contact-map"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 8,
        });
    });
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
        "spinnerColor": "#E1AF31",
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
