/* Global Variables */

/* Import Libraries */
import 'toastr';
import 'js-loading-overlay';

/* DOM Models */
const form = $('#myorder-form');

const orderIdInput = $('#myorder-input1');
const emailInput = $('#myorder-input2');

$(function () {
    setupNavbar();

    setupClickListeners();
});

/**
 * Function for coloring the "My Order" tab of the navbar.
 */
function setupNavbar() {
    $("#nav-link-home").attr('class', 'nav-link');
    $("#nav-link-orders").addClass('nav-link active');
}

/**
 * Function for setting up click listeners for DOM objects.
 */
function setupClickListeners() {
    form.submit(function (e) {
        e.preventDefault();

        const data = {
            order_id: orderIdInput.val(),
            email: emailInput.val(),
            _token: $('meta[name=_token]').attr('content')
        }

        getOrder(data);
    });
}

/**
 * Function for getting the relevant order from the database
 * with the given order_id and email address.
 *
 * @param {Object} orderData
 */
function getOrder(orderData) {
    showLoadingOverlay();
    $.ajax({
        type: 'POST',
        url: '/api/v1/order-details',
        data: orderData,
        success: function (data) {
            hideLoadingOverlay();
            if (data){
                window.location.href = 'order-details/' + orderData.order_id;
            }else {
                toastr.error('Bu bilgilere ait bir sipariş bulunamadı.');
            }
        },
        error: function (error) {
            hideLoadingOverlay();
            console.log(error);
            toastr.error('Bu bilgilere ait bir sipariş bulunamadı.');
        }
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
