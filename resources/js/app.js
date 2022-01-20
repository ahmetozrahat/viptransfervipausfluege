require('./bootstrap');

import $ from "jquery";

let currency = undefined;

$(function () {
    loadCurrency();

    switchCurrency();

    initializeView();

    handleClickListeners();
});

function loadCurrency() {
    let cookies = document.cookie.split(';');

    cookies.forEach(element => {
        if (element.includes('currency')) {
            switch (element.split('=')[1]) {
                case 'tl':
                    // Load Turkish Liras currency.
                    currency = "tl";
                    break;
                case 'usd':
                    // Load United States Dollars currency.
                    currency = "usd";
                    break;
                case 'eur':
                    // Load Euros currency.
                    currency = "eur";
                    break;
                default:
                    currency = "tl";
                    break;
            }
        }
    });
}

function switchCurrency() {
    $("#navbarDropdownCurrency a").on('click', function () {
        if ($(this).attr('id') == 'currency_tl') {
            document.cookie = "currency=tl";
        } else if ($(this).attr('id') == 'currency_usd') {
            document.cookie = "currency=usd";
        } else if ($(this).attr('id') == 'currency_eur') {
            document.cookie = "currency=eur";
        } else {
            document.cookie = "currency=eur";
        }

        location.reload();
    });
}

function initializeView() {
    $("#booking-select-transfer-point-col2").hide();
    $("#booking-select-airport-col3").hide();

    $("#passenger-dropdown").css("display", "none");
}

function handleClickListeners() {
    $("#booking-select-transfer-direction").on('change', function () {

        $("#booking-select-transfer-point-col2").empty();
        $("#booking-select-transfer-point-col3").empty();
        $("#booking-select-airport-col2").empty();
        $("#booking-select-airport-col3").empty();

        switch (lang) {
            case "tr":
                $("#booking-select-transfer-point-col2").html('<option value="" disabled selected>' + languageFile.tr.booking_section_col3 + '</option>');
                $("#booking-select-transfer-point-col3").html('<option value="" disabled selected>' + languageFile.tr.booking_section_col3 + '</option>');
                $("#booking-select-airport-col2").html('<option value="" disabled selected>' + languageFile.tr.booking_section_col2 + '</option>');
                $("#booking-select-airport-col3").html('<option value="" disabled selected>' + languageFile.tr.booking_section_col2 + '</option>');
                break;
            case "en":
                $("#booking-select-transfer-point-col2").html('<option value="" disabled selected>' + languageFile.en.booking_section_col3 + '</option>');
                $("#booking-select-transfer-point-col3").html('<option value="" disabled selected>' + languageFile.en.booking_section_col3 + '</option>');
                $("#booking-select-airport-col2").html('<option value="" disabled selected>' + languageFile.en.booking_section_col2 + '</option>');
                $("#booking-select-airport-col3").html('<option value="" disabled selected>' + languageFile.en.booking_section_col2 + '</option>');
                break;
            case "de":
                $("#booking-select-transfer-point-col2").html('<option value="" disabled selected>' + languageFile.de.booking_section_col3 + '</option>');
                $("#booking-select-transfer-point-col3").html('<option value="" disabled selected>' + languageFile.de.booking_section_col3 + '</option>');
                $("#booking-select-airport-col2").html('<option value="" disabled selected>' + languageFile.de.booking_section_col2 + '</option>');
                $("#booking-select-airport-col3").html('<option value="" disabled selected>' + languageFile.de.booking_section_col2 + '</option>');
                break;
            default:
                $("#booking-select-transfer-point-col2").html('<option value="" disabled selected>' + languageFile.de.booking_section_col3 + '</option>');
                $("#booking-select-transfer-point-col3").html('<option value="" disabled selected>' + languageFile.de.booking_section_col3 + '</option>');
                $("#booking-select-airport-col2").html('<option value="" disabled selected>' + languageFile.de.booking_section_col2 + '</option>');
                $("#booking-select-airport-col3").html('<option value="" disabled selected>' + languageFile.de.booking_section_col2 + '</option>');
                break;
        }

        if ($(this).val() == 1 || $(this).val() == 2) {
            $("#booking-select-airport-col2").show();
            $("#booking-select-airport-col2").prop('required', true);

            $("#booking-select-transfer-point-col2").hide();
            $("#booking-select-transfer-point-col2").prop('required', false);

            $("#booking-select-airport-col3").hide();
            $("#booking-select-airport-col3").prop('required', false);

            $("#booking-select-transfer-point-col3").show();
            $("#booking-select-transfer-point-col3").prop('required', true);
        } else {
            $("#booking-select-airport-col2").hide();
            $("#booking-select-airport-col2").prop('required', false);

            $("#booking-select-transfer-point-col2").show();
            $("#booking-select-transfer-point-col2").prop('required', true);

            $("#booking-select-airport-col3").show();
            $("#booking-select-airport-col3").prop('required', true);

            $("#booking-select-transfer-point-col3").hide();
            $("#booking-select-transfer-point-col3").prop('required', false);
        }

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

function updatePassengerCount() {
    let adultquantity = parseInt($("#passenger-adult-quantity").val(), 10);
    let kidquantity = parseInt($("#passenger-kid-quantity").val(), 10);
    let babyquantity = parseInt($("#passenger-baby-quantity").val(), 10);

    switch (lang) {
        case "tr":
            $("#passengers-count").html((adultquantity + kidquantity + babyquantity) + " " + languageFile.tr.person);
            break;
        case "en":
            $("#passengers-count").html((adultquantity + kidquantity + babyquantity) + " " + languageFile.en.person);
            break;
        case "de":
            $("#passengers-count").html((adultquantity + kidquantity + babyquantity) + " " + languageFile.de.person);
            break;
        default:
            $("#passengers-count").html((adultquantity + kidquantity + babyquantity) + " " + languageFile.de.person);
            break;
    }
}

function getAirportList() {
    $.ajax({
        url: "v1/getAirports.php",
        type: "post",
        success: function (response) {
            if (response !== false && response !== undefined) {

                let data = JSON.parse(response);

                for (let i = 0; i < data.length; i++) {

                    $("#booking-select-airport-col2").append(
                        '<option value=' + data[i].id + '>' + data[i].name + '</option>'
                    );

                    $("#booking-select-airport-col3").append(
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

function getTransferPoints() {
    $.ajax({
        url: "v1/getTransferPoints.php",
        type: "post",
        success: function (response) {
            if (response !== false && response !== undefined) {

                let data = JSON.parse(response);

                for (let i = 0; i < data.length; i++) {

                    $("#booking-select-transfer-point-col2").append(
                        '<option value=' + data[i].id + '>' + data[i].name + '</option>'
                    );

                    $("#booking-select-transfer-point-col3").append(
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