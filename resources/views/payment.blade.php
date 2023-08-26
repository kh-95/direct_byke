<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
if (env('APP_ENV') == 'local') {
    $url = "https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId";
} else {
    $url = "https://eu-prod.oppwa.com/v1/paymentWidgets.js?checkoutId";
}
?>
@if($paymentMethod->payment =='APPLEPAY')
    <style>
        .wpwl-form {
            height: 500px !important;
        }

        .wpwl-apple-pay-button {
            font-size: 24px !important;
            width: 100% !important;
            height: 100% !important;
            -webkit-appearance: -apple-pay-button;
            -apple-pay-button-type: buy;
            margin-top: 75% !important;
            background: #eee;
            text-align: center;
            padding: 6rem;
        }

    </style>
@endif

<form action="{{$Rollback}}"
      class="paymentWidgets"
      data-brands="{{$paymentMethod->payment}}">
</form>

<script src=" {{$url}}={{ $invoice->transaction_id}}"></script>

<script type="text/javascript">

    var wpwlOptions = {
        style: '{{$paymentMethod->payment=='APPLEPAY'?"plain":"card"}}',
        @if($paymentMethod->payment=='APPLEPAY')
        iframeStyles: {
            'wpwl-group-submit': {
                'color': '#000000',
                'font-size': '16px',
            },
            'wpwl-button-pay': {
                'color': '#000000',
                'font-size': '16px',
            }
        }
        @endif
        paymentTarget: "_top",
        browser: {
            threeDChallengeWindow: 5
        }
    }
</script>

