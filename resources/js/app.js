require('./bootstrap');

import $ from "jquery";

/**
 * Initialize the view objects with the proper names
 * in order to use them in functions with a meaningful way.
 */
let body = $('body');

let transferDirectionCol = $('#booking-select-transfer-direction');

let transferPointName = $('#transfer-point-name');
let transferPointCol2 = $('#booking-select-transfer-point-col2');
let transferPointCol3 = $('#booking-select-transfer-point-col3');

let airportName = $('#airport-name');
let airportCol2 = $('#booking-select-airport-col2');
let airportCol3 = $('#booking-select-airport-col3');

let passengerDropdownCol = $("#booking-select-passengers");
let passengerCount = $('#passengers-count')
let passengerDropdown = $('#passenger-dropdown');

let passengerAdultQuantity = $('#passenger-adult-quantity');
let passengerAdultIncrement = $('#btn-increment-adult-quantity');
let passengerAdultDecrement = $('#btn-decrement-adult-quantity');

let passengerKidQuantity = $('#passenger-kid-quantity');
let passengerKidIncrement = $('#btn-increment-kid-quantity');
let passengerKidDecrement = $('#btn-decrement-kid-quantity');

let passengerBabyQuantity = $('#passenger-baby-quantity');
let passengerBabyIncrement = $('#btn-increment-baby-quantity');
let passengerBabyDecrement = $('#btn-decrement-baby-quantity');

let passengerQuantitySubmit = $('#passenger-quantity-submit');

/**
 * Let's create variables for holding the translations for
 * transfer point column and airport column.
 *
 * We will get it from the HTML's meta tag.
*/

let airportTranslation = $('meta[name="airport-translation"]').attr('content');
let transferPointTranslation = $('meta[name="transfer-point-translation"]').attr('content');

$(function () {
    initializeView();

    handleClickListeners();
});

/**
 * Initialize the form with a default transfer type
 * of From Airport to Transfer Point.
 *
 * So we will hide the transfer point from column-2 and
 * hide the airport from column-3.
 *
 * We will also need to hide the passenger count view.
 */
function initializeView() {
    transferPointCol2.hide();
    airportCol3.hide();

    passengerDropdown.css("display", "none");
}

/**
 * Function for registering click events.
 */
function handleClickListeners() {
    transferDirectionCol.on('change', function () {
        // First clear the column-2 and column-3.
        transferPointCol2.empty();
        transferPointCol3.empty();
        airportCol2.empty();
        airportCol3.empty();

        // Append the translation strings to the columns.
        transferPointCol2.html(`<option value="" disabled selected> ${transferPointTranslation}`);
        transferPointCol3.html(`<option value="" disabled selected> ${transferPointTranslation}`);
        airportCol2.html(`<option value="" disabled selected> ${airportTranslation}`);
        airportCol3.html(`<option value="" disabled selected> ${airportTranslation}`);

        // Check if the transfer type is
        // with return
        // or
        // from airport to transfer point.
        if ($(this).val() == 1 || $(this).val() == 2) {
            // Show the airport field on column-2.
            // Show the transfer point field on column-3.
            // Hide the unnecessary fields.

            airportCol2.show();
            airportCol2.prop('required', true);

            transferPointCol2.hide();
            transferPointCol2.prop('required', false);

            airportCol3.hide();
            airportCol3.prop('required', false);

            transferPointCol3.show();
            transferPointCol3.prop('required', true);
        } else {
            // Show the transfer point field on column-2.
            // Show the airport field on column-3.
            // Hide the unnecessary fields.

            airportCol2.hide();
            airportCol2.prop('required', false);

            transferPointCol2.show();
            transferPointCol2.prop('required', true);

            airportCol3.show();
            airportCol3.prop('required', true);

            transferPointCol3.hide();
            transferPointCol3.prop('required', false);
        }

        // Fetch the airport list.
        getAirportList();
    });

    body.on('change', '#booking-select-airport-col2', function () {
        airportName.val(
            $("#booking-select-airport-col2 option:selected").text()
        );
        getTransferPoints();
    });

    body.on('change', '#booking-select-airport-col3', function () {
        airportName.val(
            $("#booking-select-airport-col3 option:selected").text()
        );
        getTransferPoints();
    });

    body.on('change', '#booking-select-transfer-point-col2', function () {
        transferPointName.val(
            $("#booking-select-transfer-point-col2 option:selected").text()
        );
    });

    body.on('change', '#booking-select-transfer-point-col3', function () {
        transferPointName.val(
            $("#booking-select-transfer-point-col3 option:selected").text()
        );
    });

    // For showing and hiding the dropdown menu
    // when clicking the 'booking-select-passengers'
    passengerDropdownCol.on('click', function () {
        if (passengerDropdown.is(":visible")) {
            passengerDropdown.css("display", "none");
        } else {
            passengerDropdown.css("display", "block");
        }
    });

    // Incrementing the Adult Quantity when clicked +
    passengerAdultIncrement.on('click', function () {
        updatePassengerCount(passengerAdultQuantity, true);
    });

    // Decrementing the Adult Quantity when clicked -
    // if the value is greater than 1
    passengerAdultDecrement.on('click', function () {
        updatePassengerCount(passengerAdultQuantity, false);
    });

    // Incrementing the Kid Quantity when clicked +
    passengerKidIncrement.on('click', function () {
        updatePassengerCount(passengerKidQuantity, true);
    });

    // Decrementing the Kid Quantity when clicked -
    // if the value is greater than 0
    passengerKidDecrement.on('click', function () {
        updatePassengerCount(passengerKidQuantity, false);
    });

    // Incrementing the Baby Quantity when clicked +
    passengerBabyIncrement.on('click', function () {
        updatePassengerCount(passengerBabyQuantity, true);
    });

    // Decrementing the Baby Quantity when clicked -
    // if the value is greater than 0
    passengerBabyDecrement.on('click', function () {
        updatePassengerCount(passengerBabyQuantity, false);
    });

    passengerQuantitySubmit.on('click', function () {
        passengerDropdown.css("display", "none");
    });
}

/**
 * Function for incrementing or decrementing a given field,
 * and updating the total amount of quantity.
 *
 * @param view
 * @param isIncremented
 */
function updatePassengerCount(view, isIncremented) {
    if (isIncremented) {
        // Increment the given view by 1.
        let previous = parseInt(view.val(), 10);
        view.val(previous + 1);
    }else {
        // Decrement the given view by 1 if possible.
        let previous = parseInt(view.val(), 10);

        if (previous > 1)
            view.val(previous - 1);
    }

    // Update quantity.
    let adultQuantity = parseInt(passengerAdultQuantity.val(), 10);
    let kidQuantity = parseInt(passengerKidQuantity.val(), 10);
    let babyQuantity = parseInt(passengerBabyQuantity.val(), 10);

    passengerCount.html((adultQuantity + kidQuantity + babyQuantity));
}

/**
 * Function for getting the airport list.
 */
function getAirportList() {
    $.ajax({
        url: "v1/getAirports.php",
        type: "post",
        success: function (response) {
            if (response !== false && response !== undefined) {

                let data = JSON.parse(response);

                for (let i = 0; i < data.length; i++) {

                    airportCol2.append(
                        '<option value=' + data[i].id + '>' + data[i].name + '</option>'
                    );

                    airportCol3.append(
                        '<option value=' + data[i].id + '>' + data[i].name + '</option>'
                    );
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

/**
 * Function for getting the transfer points.
 */
function getTransferPoints() {
    $.ajax({
        url: "v1/getTransferPoints.php",
        type: "post",
        success: function (response) {
            if (response !== false && response !== undefined) {

                let data = JSON.parse(response);

                for (let i = 0; i < data.length; i++) {

                    transferPointCol2.append(
                        '<option value=' + data[i].id + '>' + data[i].name + '</option>'
                    );

                    transferPointCol3.append(
                        '<option value=' + data[i].id + '>' + data[i].name + '</option>'
                    );
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
