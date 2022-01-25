/* Global variables */

/* Import Libraries */
import Litepicker from 'litepicker';
import intlTelInput from 'intl-tel-input';
import cookies from "js-cookie";
import 'js-loading-overlay';
import 'toastr';

/* Object Declaration */

let landDate = undefined;
let transferDate = undefined;
let returnFlightDate = undefined;
let returnTransferDate = undefined;

let lang = undefined;
let pickerLang = undefined;
let iti = undefined;

let isTransferAgreementAccepted = false;
let isMailListAccepted = false;

const apiURL = 'https://api.exchangerate-api.com/v4/latest/EUR';

/* DOM elements */

const orderFlightHour = $('#order-flight-hour');
const orderFlightMinute = $('#order-flight-minute');

const orderReturnFlightHour = $('#order-flight-hour2');
const orderReturnFlightMinute = $('#order-flight-minute2');

const orderTransferHour = $('#order-transfer-hour');
const orderTransferMinute = $('#order-transfer-minute');

const orderReturnTransferHour = $('#order-transfer-hour2');
const orderReturnTransferMinute = $('#order-transfer-minute2');

const transferOrderPrice = $('#transfer-order-price');
const transferOrderDiscount = $('#transfer-order-discount');
const transferOrderTotal = $('#transfer-order-total');

/**
 * Function executed when the page successfully loaded.
 */
$(function () {
    setupDatePicker();

    setupPhoneInputFormatter();

    setupCurrency();

    setupClickListeners();
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

    // The default date picker language is set to be Deutsch.
    pickerLang = 'de-DE';

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
        element: document.querySelector('#order-flight-date'),
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
                landDate = {
                    day: day,
                    month: month+1,
                    year: year,
                    hour: 12,
                    minute: 30
                }

                // Set the hours and minutes to the input fields.
                orderFlightHour.val(landDate.hour);
                orderFlightMinute.val(landDate.minute);
            });
        }
    });

    // If the order is with return, there will be an extra
    // transfer date, so we should create another date picker for this.
    if (document.getElementById('order-transfer-date') !== null &&
        document.getElementById('order-transfer-date') !== undefined) {
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
                    transferDate = {
                        year: year,
                        month: month + 1,
                        day: day,
                        hour: 12,
                        minute: 30
                    }

                    // Set the hours and minutes to the input fields.
                    orderTransferHour.val(transferDate.hour);
                    orderTransferMinute.val(transferDate.minute);
                });
            }
        });
    }

    // If the order is two ways, there will be a coming date and returning date.
    // So we should create two more date picker fields for this.
    if (document.getElementById('order-flight-date2') !== null &&
        document.getElementById('order-flight-date2') !== undefined) {

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
                    returnFlightDate = {
                        year: year,
                        month: month + 1,
                        day: day,
                        hour: 12,
                        minute: 30
                    }

                    // Set the hours and minutes to the input fields.
                    orderReturnFlightHour.val(returnFlightDate.hour);
                    orderReturnFlightMinute.val(returnFlightDate.minute);
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
                    returnTransferDate = {
                        year: year,
                        month: month + 1,
                        day: day,
                        hour: 12,
                        minute: 30
                    }

                    // Set the hours and minutes to the input fields.
                    orderReturnTransferHour.val(returnTransferDate.hour);
                    orderReturnTransferMinute.val(returnTransferDate.minute);
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
    iti = intlTelInput(input, {
        utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.15/js/utils.min.js',
        autoPlaceholder: 'aggressive',
        preferredCountries: ['de', 'tr'],
        initialCountry: 'tr',
        separateDialCode: true
    });
}

/**
 * Function for retrieving the currency data from cookies.
 *
 * @return {String} Currency string tl, usd, eur
 */
function retrieveCurrencyFromCookies(callback) {
    if (cookies.get('currency') !== undefined && cookies.get('currency') !== null) {
        let currency = cookies.get('currency');
        callback(currency);
    }else {
        cookies.set('currency', 'eur');
        callback('eur');
    }
}

/**
 * Function for setting up the currency.
 */
function setupCurrency() {
    retrieveCurrencyFromCookies(function (currency) {
        switch (currency) {
            case 'tl':
                convertPrices('tl');
                break;
            case 'usd':
                convertPrices('usd');
                break;
            case 'eur':
                convertPrices('eur');
                break;
            default:
                convertPrices('eur');
                break;
        }
    });
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
    let transferOrderPriceOld = parseFloat(transferOrderPrice.attr('price'));
    let transferOrderPriceNew = transferOrderPriceOld * multiplier;
    transferOrderPrice.html(transferOrderPriceNew.toFixed(2) + ' ' + char);
    $('#order-converted-price').val(transferOrderPriceNew);

    let transferOrderDiscountOld = parseFloat(transferOrderDiscount.attr('price'));
    let transferOrderDiscountNew = transferOrderDiscountOld * multiplier;
    transferOrderDiscount.html(transferOrderDiscountNew.toFixed(2) + ' ' + char);

    let transferOrderTotalOld = parseFloat(transferOrderTotal.attr('price'));
    let transferOrderTotalNew = transferOrderTotalOld * multiplier;
    transferOrderTotal.html(transferOrderTotalNew.toFixed(2) + ' ' + char);
}

/**
 * Function for setting up the click listeners for UI objects.
 */
function setupClickListeners() {
    // Click listener for flight land hour.
    orderFlightHour.on('change', function () {
        // Setting the hours and minutes to the landDate variable.
        landDate.hour = parseInt($(this).val());
    });

    // Click listener for flight land minute.
    orderFlightMinute.on('change', function () {
        // Setting the hours and minutes to the landDate variable.
        landDate.minute = parseInt($(this).val());
    });

    // Click listener for transfer hour.
    orderTransferHour.on('change', function () {
        // Setting the hours and minutes to the landDate variable.
        transferDate.hour = parseInt($(this).val());
    });

    // Click listener for transfer minute.
    orderTransferMinute.on('change', function () {
        // Setting the hours and minutes to the landDate variable.
        transferDate.minute = parseInt($(this).val());
    });

    // If the order is two ways, there will be a coming date and returning date.
    // We should listen for the click events for return date input fields.
    if (document.getElementById('order-flight-date2') !== null && document.getElementById('order-flight-date2') !== undefined) {
        // Click listener for return flight hour.
        orderReturnFlightHour.on('change', function () {
            // Setting the hours and minutes to the returnFlightDate variable.
            returnFlightDate.hour = parseInt($(this).val());
        });

        // Click listener for return flight minute.
        orderReturnFlightMinute.on('change', function () {
            // Setting the hours and minutes to the returnFlightDate variable.
            returnFlightDate.minute = parseInt($(this).val());
        });

        // Click listener for return transfer hour.
        orderReturnTransferHour.on('change', function () {
            // Setting the hours and minutes to the returnTransferDate variable.
            returnTransferDate.hour = parseInt($(this).val());
        });

        // Click listener for return transfer minute.
        orderReturnTransferMinute.on('change', function () {
            // Setting the hours and minutes to the returnTransferDate variable.
            returnTransferDate.minute = parseInt($(this).val());
        });
    }

    // Click listener for transfer agreement for terms of use.
    $('#transfer_agreement_link').on('click', function (e) {
        // We don't want the default behaviour of the click event.
        e.preventDefault();

        // Show the agreement modal.
        $('#agreement-modal').modal('show');
    });

    // Click listener for transfer agreement checkbox.
    $('#order-agreement-checkbox1').on('change', function () {
        // Set the checkbox state to isTransferAgreementAccepted variable.
        isTransferAgreementAccepted = $(this).prop('checked') === "on";
    });

    // Click listener for mail list agreement checkbox.
    $('#order-agreement-checkbox2').on('change', function () {
        // Set the checkbox state to isMailListAccepted variable.
        isMailListAccepted = $(this).prop('checked') === "on";
    });

    // Click listener for agree terms of use modal button.
    $('#agreement-accept').on('click', function () {
        // Set the checkbox state to true when user agrees the agreement.
        $('#order-agreement-checkbox1').prop('checked', true);

        // Hide the agreement modal.
        $('#agreement-modal').modal('hide');
    });

    // Click listener for creating an order.
    $("#order-form").submit(function (e) {
        // We don't want the default behaviour of submitting a form.
        e.preventDefault();

        // Create a form data with the current form object.
        let formData = new FormData(this);

        let orderData = {
            name: formData.get('name'),
            email: formData.get('email'),
            phone: iti.getNumber(),
            country: ~~formData.get('country'),
            flight_no: formData.get('flight-no'),
            terminal: ~~formData.get('terminal') === 0 ? null : ~~formData.get('terminal'),
            transfer_point: formData.get('transfer-point'),
            transfer_notes: formData.get('transfer-notes'),
            return_flight_no: formData.get('flight-no2'),
            return_terminal: ~~formData.get('terminal2') === 0 ? null : ~~formData.get('terminal2'),
            pickup_point: formData.get('transfer-point2'),
            return_transfer_notes: formData.get('transfer-notes2'),
            airport: ~~formData.get('airport'),
            destination: ~~formData.get('destination'),
            direction: ~~formData.get('direction'),
            passengers: ~~formData.get('passengers'),
            baby_seat: ~~formData.get('baby-seat'),
            vehicle: ~~formData.get('vehicle'),
            original_price: parseFloat(formData.get('price')),
            converted_price: parseFloat($('#order-converted-price').val()),
            email_list_agreed: $('#order-agreement-checkbox2').prop('checked'),
            _token: $('meta[name=_token]').attr('content')
        }

        // Let's call the create order function.
        createOrder(orderData);
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

/**
 * Function for returning an order ID to show to user.
 * @returns {string} XXXX-XXXXXX-XXXX formatted order id.
 */
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

/**
 * Make a call to the Twilio Lookup API.
 *
 * @see https://www.twilio.com/blog/2016/03/how-to-validate-phone-numbers-in-php-with-the-twilio-lookup-api.html
 *
 * @param {String} phone
 * @param callback
 */
function isPhoneNumberValid(phone, callback) {
    $.ajax({
        type: 'POST',
        url: '/api/v1/verify-phone',
        data: {
            _token: $('meta[name=_token]').attr('content'),
            phone_number: phone
        },
        success: function (data) {
            hideLoadingOverlay();
            if (data) {
                callback(true);
            }else {
                callback(false);
            }
        },
        error: function (error) {
            callback(false)
        }
    });
}

/**
 * Function for converting the time object we declare
 * to GMT +3 Europe/Istanbul format
 *
 * @param date Custom date object
 */
function formatTimeForIstanbul(date) {
    let dateString = '';

    dateString += date.year + '-';
    dateString += date.month / 10 >= 1 ? `${date.month}-` : `0${date.month}-`;
    dateString += date.day / 10 >= 1 ? `${date.day} ` : `0${date.day} `;
    dateString += date.hour / 10 >= 1 ? `${date.hour}:` : `0${date.hour}:`;
    dateString += date.minute / 10 >= 1 ? `${date.minute}:` : `0${date.minute}:`;
    dateString += '00';

    return dateString;
}

/**
 * Function for making an API call to create the order.
 *
 * @param {Object} data The data retrieved from the order form.
 */
function createOrder(data) {
    // Create a loading overlay object and activate it.
    // This will create a loading spinner overlay.
    showLoadingOverlay();

    // First check if the phone number is valid.
    isPhoneNumberValid(iti.getNumber(), function (isValid) {
        if (isValid) {
            // Phone number successfully validated.
            // Continue the process.

            // Get the language string from the page for the order.
            const lang = $('html').attr('lang');

            // Get the currency string for the order receipt language.
            let currency = undefined;
            retrieveCurrencyFromCookies(function (data) {
                currency = data;
            })

            let flightDateString = formatTimeForIstanbul(landDate);

            data.order_id = generateOrderID();
            data.phone =  iti.getNumber();
            data.lang = lang;
            data.currency = currency;
            data.flight_date = flightDateString;

            // If the order is with return, there will be an extra
            // transfer date, so we should add it to the form data.
            if (document.getElementById('order-transfer-date') !== null && document.getElementById('order-transfer-date') !== undefined) {
                // Inserting the transfer date string to the form data.
                data.transfer_date = formatTimeForIstanbul(transferDate);
            }

            // If the order is two ways, there will be a coming date and returning date.
            // We should create two more date strings for this.
            if (document.getElementById('order-flight-date2') !== null && document.getElementById('order-flight-date2') !== undefined) {
                let returnFlightDateString = formatTimeForIstanbul(returnFlightDate);
                let returnTransferDateString = formatTimeForIstanbul(returnTransferDate);

                // Inserting the return flight and transfer date strings to the form data.
                data.return_flight_date = returnFlightDateString;
                data.return_transfer_date = returnTransferDateString;
            }

            console.table(data);

            $.ajax({
                type: 'POST',
                url: '/api/v1/create-order',
                data: data,
                success: function (value) {
                    window.location.href = 'order-details/' + data.order_id;
                },
                error: function (error) {
                    toastr.error('Siparişiniz alınırken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.');
                }
            });
        }else {
            // Phone number is not valid. Show an error message.
            toastr.error(`Phone number ${iti.getNumber()} is not valid.`);
            hideLoadingOverlay();
        }
    });
}
