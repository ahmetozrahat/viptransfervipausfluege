require('./bootstrap');

import $ from "jquery";

/**
 * Initialize the view objects with the proper names
 * in order to use them in functions with a meaningful way.
 */
let transferDirectionCol = $('#booking-select-transfer-direction');

let transferPointCol2 = $('#booking-select-transfer-point-col2');
let transferPointCol3 = $('#booking-select-transfer-point-col3');

let airportCol2 = $('#booking-select-airport-col2');
let airportCol3 = $('#booking-select-airport-col3');;

let passengerDropdown = $('#passenger-dropdown');
let passengerAdultQuantity = $('#passenger-adult-quantity');
let passengerKidQuantity = $('#passenger-kid-quantity');
let passengerBabyQuantity = $('#passenger-baby-quantity');

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

    $('body').on('change', '#booking-select-airport-col2', function () {
        $("#airport-name").val($("#booking-select-airport-col2 option:selected").text());
        getTransferPoints();
    });

    $('body').on('change', '#booking-select-airport-col3', function () {
        $("#airport-name").val($("#booking-select-airport-col3 option:selected").text());
        getTransferPoints();
    });

    $('body').on('change', '#booking-select-transfer-point-col2', function () {
        $("#transfer-point-name").val($("#booking-select-transfer-point-col2 option:selected").text());
    });

    $('body').on('change', '#booking-select-transfer-point-col3', function () {
        $("#transfer-point-name").val($("#booking-select-transfer-point-col3 option:selected").text());
    });

    // For showing and hiding the dropdown menu
    // when clicking the 'booking-select-passengers'
    $("#booking-select-passengers").on('click', function () {
        if ($("#passenger-dropdown").is(":visible")) {
            $("#passenger-dropdown").css("display", "none");
        } else {
            $("#passenger-dropdown").css("display", "block");
        }
    });

    // Incrementing the Adult Quantity when clicked +
    $("#btn-increment-adult-quantity").on('click', function () {
        let previous = parseInt($("#passenger-adult-quantity").val(), 10);
        $("#passenger-adult-quantity").val(previous + 1);
        updatePassengerCount();
    });

    // Decrementing the Adult Quantity when clicked -
    // if the value is greater than 1
    $("#btn-decrement-adult-quantity").on('click', function () {
        let previous = parseInt($("#passenger-adult-quantity").val(), 10);

        if (previous > 1)
            $("#passenger-adult-quantity").val(previous - 1);

        updatePassengerCount();
    });

    // Incrementing the Kid Quantity when clicked +
    $("#btn-increment-kid-quantity").on('click', function () {
        let previous = parseInt($("#passenger-kid-quantity").val(), 10);
        $("#passenger-kid-quantity").val(previous + 1);
        updatePassengerCount();
    });

    // Decrementing the Kid Quantity when clicked -
    // if the value is greater than 0
    $("#btn-decrement-kid-quantity").on('click', function () {
        let previous = parseInt($("#passenger-kid-quantity").val(), 10);

        if (previous > 0)
            $("#passenger-kid-quantity").val(previous - 1);

        updatePassengerCount();
    });

    // Incrementing the Baby Quantity when clicked +
    $("#btn-increment-baby-quantity").on('click', function () {
        let previous = parseInt($("#passenger-baby-quantity").val(), 10);
        $("#passenger-baby-quantity").val(previous + 1);
        updatePassengerCount();
    });

    // Decrementing the Baby Quantity when clicked -
    // if the value is greater than 0
    $("#btn-decrement-baby-quantity").on('click', function () {
        let previous = parseInt($("#passenger-baby-quantity").val(), 10);

        if (previous > 0)
            $("#passenger-baby-quantity").val(previous - 1);

        updatePassengerCount();
    });

    $("#passenger-quantity-submit").on('click', function () {
        $("#passenger-dropdown").css("display", "none");
    });
}

/**
 * Function for updating the passenger count
 * when the quantity is changed.
 */
function updatePassengerCount() {
    let adultquantity = parseInt(passengerAdultQuantity.val(), 10);
    let kidquantity = parseInt(passengerKidQuantity.val(), 10);
    let babyquantity = parseInt(passengerBabyQuantity.val(), 10);

    $('#passengers-count').html((adultquantity + kidquantity + babyquantity));
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
