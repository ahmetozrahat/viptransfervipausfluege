import $ from "jquery";

$(function () {
    $("#nav-link-home").attr('class', 'nav-link');
    $("#nav-link-contact").addClass('nav-link active');

    // Toast mesajlarini gosterirken z-index artirip
    // Gizlerken z-index azaltiyoruz.

    let successToast = document.getElementById('success-toast');
    let failureToast = document.getElementById('failure-toast');

    successToast.addEventListener('show.bs.toast', function () {
        $('#success-toast-container').css('z-index', '11');
    });

    successToast.addEventListener('hide.bs.toast', function () {
        $('#success-toast-container').css('z-index', '-1');
    });

    failureToast.addEventListener('show.bs.toast', function () {
        $('#failure-toast-container').css('z-index', '11');
    });

    failureToast.addEventListener('hide.bs.toast', function () {
        $('#failure-toast-container').css('z-index', '-1');
    });

    $('#contact-form').submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "v1/createContactTicket.php",
            data: formData,
            type: "post",
            success: function (response) {
                if (response !== false && response !== undefined) {
                    let json = $.parseJSON(response);

                    if (json['error'] != false) {
                        $('#failure-toast').toast('show');

                    } else {
                        $('#success-toast').toast('show');
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    //initMap();
});


// Loading the google maps.
function initMap() {
    // The location of Company
    const location = {
        lat: 36.90121813023178,
        lng: 30.822260469121233
    };

    // The map, centered at Location
    const map = new google.maps.Map(document.getElementById("contact-map"), {
        zoom: 15,
        center: location,
    });

    // The marker, positioned at Location
    const marker = new google.maps.Marker({
        position: location,
        map: map,
    });
}