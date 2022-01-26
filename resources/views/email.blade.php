<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, minimum-scale=1.0" />
    <title>Vip Transfer Vip Ausfluege</title>

    <!-- Google Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- User Defined CSS -->
    <style>
        body {
            text-align: center;
        }

        .order-details {
            width: 80%;
            margin: 50px auto;
        }

        .order-success {
            margin: auto;
            padding: 10px 0;
            color: #25d366;
        }

        .order-success-title {
            font-family: "Source Sans Pro", sans-serif;
            font-weight: 300;
            font-size: 2rem;
            line-height: 180%;
            text-align: center;
        }

        .order-id {
            font-family: "Source Sans Pro", sans-serif;
            font-weight: bold;
            font-size: 1.3rem;
            text-align: center;
        }

        .order-details {
            font-family: "Source Sans Pro", sans-serif;
            font-weight: 300;
            font-size: 1.3rem;
            text-align: center;
        }

        .order-details-table {
            font-family: "Source Sans Pro", sans-serif;
            font-size: 1.2rem;
            margin: auto;
        }

        .order-details-row {
            width: 50%;
        }

        .table-seperator {
            font-family: "Source Sans Pro", sans-serif;
            font-weight: bold;
            font-size: 1.5rem;
            text-align: center;
            padding: 30px 0;
        }

        .order-details-left-col {
            font-weight: bold;
            text-align: right;
            padding: 10px 50px;
        }

        .order-details-right-col {
            text-align: left;
        }

        hr {
            width: 30%;
            color: #ededed;
        }

        @media only screen and (max-width: 768px) {

            td,
            tr {
                display: block;
                text-align: center !important;
            }

            .order-details-row {
                width: 100%;
            }

            .order-details-left-col {
                padding: 10px 0;
            }

            hr {
                width: 50%;
            }
        }

        .company-info {
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 400;
            padding: 50px;
            color: grey;
            text-align: center;
        }

        .company-info a {
            color: #78c4d4;
        }
    </style>
</head>

<body>

@yield('content')

<!-- Divider -->
<hr>

<!-- Company Info -->
<div class="company-info">
    <div class="company-info-text">
        {!! __('mail_order_footer_1', ['email' => $order->email]) !!}
    </div>
    <br>
    <div class="company-info-help">
        {!! __('mail_order_footer_2') !!}
    </div>
    <br><br>
    <div class="company-info-address">
        Kemerağzı Mah. Yaşar Sabutay Blv. Karnas iş Mrk. No: 14/13 Aksu/ Antalya
    </div>
</div>

</body>

</html>
