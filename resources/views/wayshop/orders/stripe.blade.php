@extends('wayshop.layouts.master')
@section('content')
    @if (Session::has('flash_message_error'))
        <div class="alert alert-sm alert-danger alert-block" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{!! session('flash_message_error') !!}</strong>
        </div>
    @endif

    @if (Session::has('flash_message_success'))
        <div class="alert alert-sm alert-success alert-block" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{!! session('flash_message_success') !!}</strong>
        </div>
    @endif
    <div class="cart-box-main">
        <div class="container">
            <h1 align="center">Thanks For Purchasing Us!</h1><br><br>
            <div class="row">
                <div class="col-lg-6">
                    <div align="center">
                        <h2>YOUR COD ORDER HAS BEEN PLACED</h2>
                        <P>Your Order Number is {{Session::get('order_id')}} and total payable about is {{Session::get('grand_total')}} vnđ</P>
                        <b>Please make payment by entering your credit or debit card</b>
                    </div>
                </div>
                <div class="col-lg-6">
                    <script src="https://js.stripe.com/v3/"></script>

                    <form action="{{url('/stripe')}}" method="post" id="payment-form">
                        @csrf
                        <div class="form-row">
                            <b>Total Amount</b>
                            <input type="text" name="total_amount" placeholder="Enter Total Amount" class="form-control">
                            <b>Your Name</b>
                            <input type="text" name="name" placeholder="Enter Your Name" class="form-control">
                            <b>Card Name</b>
                            <div id="card-element"  class="form-control">
                                <!-- A Stripe Element will be inserted here. -->
                              </div>
                        </div>
                        <button class="btn btn-success btn-mini" style="float:right;margin-top:10px;">Submit Payment</button>
                    </form>
                    <div class="card-error" role="alert"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Create a Stripe client.
        var stripe = Stripe('pk_test_51GyWepFUnGWUDfxsMiEUO09MHvFPEITW6bNdxAFIEBETNBAOTZBtMAw1VQXsLNR2tQwc4PbmPcGPhyc6qp6sfEsS00VARil8KT');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
            color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
            } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
            }
        });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
        }
    </script>
@endsection

<?php
    Session::forget('order_id');
    Session::forget('grand_total');
?>
