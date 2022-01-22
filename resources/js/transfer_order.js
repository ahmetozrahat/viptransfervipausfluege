/* Global variables */

import $ from 'jquery';
import Litepicker from 'litepicker';
import intlTelInput from 'intl-tel-input';
import 'js-loading-overlay'

let landDate = new Date();
let transferDate = new Date();

let returnFlightDate = new Date();
let returnTransferDate = new Date();

let lang = undefined;
let pickerLang = undefined;

/**
 * Function executed when the page successfully loaded.
 */
$(function () {
    setupDatePicker();

    setupPhoneInputFormatter();
});

/**
 * Function for setting up the date pickers.
 */
function setupDatePicker() {
    // Create a new date and add one day to get tomorrow's date.
    // We will use tomorrow to choose only the dates after today.
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1)

    // The default date picker language is set to be Turkish.
    pickerLang = 'tr-TR';

    // Change the locale and the picker language
    // according to the html page lang attribute.
    switch ($('html').attr('lang')) {
        case 'tr':
            lang = 'tr';
            pickerLang = 'tr-TR';
            break;
        case 'en':
            lang = 'en'
            pickerLang = 'en-US'
            break;
        case 'de':
            lang = 'de'
            pickerLang = 'de-DE'
            break;
        default:
            lang = 'de'
            pickerLang = 'de-DE'
            break;
    }

    // Create the date picker object for the flight land date.
    new Litepicker({
        element: document.getElementById('order-flight-date'),
        format: 'D.M.YYYY',
        minDate: tomorrow,
        lang: pickerLang,
        setup: (picker) => {
            picker.on('selected', (date1, date2) => {
                // Get the date values from the date picker.
                let year = date1.getFullYear();
                let month = date1.getMonth();
                let day = date1.getDate();

                // Set the picker's date to the landDate global variable.
                landDate = new Date(year, month, day, 12, 30);

                // Set the flight date string to the input field.
                $('#order-flight-date').val(landDate.toLocaleDateString(pickerLang));

                // Set the hours and minutes to the input fields.
                $('#order-flight-hour').val(landDate.getHours());
                $('#order-flight-minute').val(landDate.getMinutes());
            });
        }
    });

    // If the order is with return, there will be an extra
    // transfer date, so we should create another date picker for this.
    if (document.getElementById('order-transfer-date') !== null && document.getElementById('order-transfer-date') !== undefined) {
        // Create the date picker object for the flight transfer date.
        new Litepicker({
            element: document.getElementById('order-transfer-date'),
            format: 'D.M.YYYY',
            minDate: tomorrow,
            lang: pickerLang,
            setup: (picker) => {
                picker.on('selected', (date1, date2) => {
                    // Get the date values from the date picker.
                    let year = date1.getFullYear();
                    let month = date1.getMonth();
                    let day = date1.getDate();

                    // Set the picker's date to the transferDate global variable.
                    transferDate = new Date(year, month, day, 12, 30);

                    // Set the transfer date string to the input field.
                    $('#order-transfer-date').val(transferDate.toLocaleDateString(pickerLang));

                    // Set the hours and minutes to the input fields.
                    $('#order-transfer-hour').val(transferDate.getHours());
                    $('#order-transfer-minute').val(transferDate.getMinutes());
                });
            }
        });
    }

    // If the order is two ways, there will be a coming date and returning date.
    // So we should create two more date picker fields for this.
    if (document.getElementById('order-flight-date2') !== null && document.getElementById('order-flight-date2') !== undefined) {

        // Date picker for return flight date.
        new Litepicker({
            element: document.getElementById('order-flight-date2'),
            format: 'D.M.YYYY',
            minDate: tomorrow,
            lang: pickerLang,
            setup: (picker) => {
                picker.on('selected', (date1, date2) => {
                    // Get the date values from the date picker.
                    let year = date1.getFullYear();
                    let month = date1.getMonth();
                    let day = date1.getDate();

                    // Set the picker's date to the returnFlightDate global variable.
                    returnFlightDate = new Date(year, month, day, 12, 30);

                    // Set the flight date string to the input field.
                    $('#order-flight-date2').val(returnFlightDate.toLocaleDateString(pickerLang));

                    // Set the hours and minutes to the input fields.
                    $('#order-flight-hour2').val(returnFlightDate.getHours());
                    $('#order-flight-minute2').val(returnFlightDate.getMinutes());
                });
            }
        });

        // Date picker for return transfer date.
        new Litepicker({
            element: document.getElementById('order-transfer-date2'),
            format: 'D.M.YYYY',
            minDate: tomorrow,
            lang: pickerLang,
            setup: (picker) => {
                picker.on('selected', (date1, date2) => {
                    // Get the date values from the date picker.
                    let year = date1.getFullYear();
                    let month = date1.getMonth();
                    let day = date1.getDate();

                    // Set the picker's date to the returnTransferDate global variable.
                    returnTransferDate = new Date(year, month, day, 12, 30);

                    // Set the flight date string to the input field.
                    $('#order-transfer-date2').val(returnTransferDate.toLocaleDateString(pickerLang));

                    // Set the hours and minutes to the input fields.
                    $('#order-transfer-hour2').val(returnTransferDate.getHours());
                    $('#order-transfer-minute2').val(returnTransferDate.getMinutes());
                });
            }
        });
    }
}

/**
 * Function for formatting the phone input
 * with country flags and dial codes.
 */
function setupPhoneInputFormatter() {
    const input = document.querySelector('#order-personal-phone');
    intlTelInput(input, {
        utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.15/js/utils.min.js',
        autoPlaceholder: 'aggressive',
        preferredCountries: ['de', 'tr'],
        separateDialCode: true
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

function generateOrderID() {
    let array = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
    'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',1,2,3,4,5,6,7,8,9];
    let orderId = '';

    // Timestamp
    let timestamp = Date.now().toString();

    // First 4 digits
    orderId += timestamp.slice(0,4);
    orderId += '-'

    // Middle 6 digits
    for (let i = 0; i < 6; i++) {
        let rand = Math.floor(Math.random() * array.length);
        orderId += array[rand];
    }
    orderId += '-';

    // Last 4 digits
    orderId += timestamp.slice(9,13);

    return orderId;
}
