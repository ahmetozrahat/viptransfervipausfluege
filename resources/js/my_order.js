import $ from "jquery";

$(function () {
    $("#nav-link-home").attr('class', 'nav-link');
    $("#nav-link-orders").addClass('nav-link active');

    $('#myorder-form').submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "v1/getOrderFromIdEmail.php",
            data: formData,
            type: "post",
            success: function (response) {
                if (response !== false && response !== undefined) {
                    let json = $.parseJSON(response);

                    if (json.error === true) {
                        console.log(json.error);
                        $.toast({
                            heading: 'Error',
                            text: json.message,
                            showHideTransition: 'fade',
                            bgColor: '#FF0033',
                            textColor: '#fff',
                            allowToastClose: true,
                            hideAfter: 5000,
                            stack: 5,
                            textAlign: 'left',
                            position: 'top-right',
                            icon: 'error',
                            loader: false
                        });
                    } else {
                        let order = json.order[0];

                        const newFormData = new FormData();
                        newFormData.set('id', order.id);

                        switch (order.direction) {
                            case 1:
                                // Two ways
                                getOrderWithTwoWays(newFormData);
                                break;
                            case 2:
                                // Default
                                getOrder(newFormData);
                                break;
                            case 3:
                                // With return
                                getOrderWithReturn(newFormData);
                                break;
                        }
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
    })
});

function getOrder(id) {
    $.ajax({
        url: "v1/getOrderFromId.php",
        data: id,
        type: "post",
        success: function (response) {
            if (response !== false && response !== undefined) {
                let json = $.parseJSON(response);

                let order = json['order'][0];

                if (json['error'] != true) {
                    post('orderReceived.php', order);
                } else {
                    console.log(json);
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
}

function getOrderWithReturn(id) {
    $.ajax({
        url: "v1/getOrderFromIdWithReturn.php",
        data: id,
        type: "post",
        success: function (response) {
            if (response !== false && response !== undefined) {
                let json = $.parseJSON(response);

                let order = json['order'][0];

                if (json['error'] != true) {
                    post('orderReceivedWithReturn.php', order);
                } else {
                    console.log(json);
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
}

function getOrderWithTwoWays(id) {
    $.ajax({
        url: "v1/getOrderFromIdWithTwoWays.php",
        data: id,
        type: "post",
        success: function (response) {
            if (response !== false && response !== undefined) {
                let json = $.parseJSON(response);

                let order = json['order'][0];

                if (json['error'] != true) {
                    post('orderReceivedWithTwoWays.php', order);
                } else {
                    console.log(json);
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
}

// Post to the provided URL with the specified parameters.
function post(path, parameters) {
    var form = $('<form></form>');

    form.attr("method", "post");
    form.attr("action", path);

    $.each(parameters, function (key, value) {
        var field = $('<input></input>');

        field.attr("type", "hidden");
        field.attr("name", key);
        field.attr("value", value);

        form.append(field);
    });

    // The form needs to be a part of the document in
    // order for us to be able to submit it.
    $(document.body).append(form);
    form.submit();
}