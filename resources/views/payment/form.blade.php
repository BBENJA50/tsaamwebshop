
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Make a Payment</h1>

        <form id="payment-form">
            @csrf
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" id="amount" name="amount" class="form-control" value="{{ old('amount') }}" required>
            </div>

            <div class="form-group">
                <label for="card-element">Credit or debit card</label>
                <div id="card-element" class="form-control"></div>
                <div id="card-errors" role="alert"></div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit Payment</button>
        </form>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const stripe = Stripe('{{ config('services.stripe.key') }}');
            const elements = stripe.elements();
            const card = elements.create('card');
            card.mount('#card-element');

            card.on('change', (event) => {
                const displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            const form = document.getElementById('payment-form');
            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const {paymentIntent, error} = await stripe.createPayment({
                    payment_method: {
                        card: card,
                        billing_details: {
                            name: 'Cardholder Name',
                        },
                    },
                });

                if (error) {
                    const errorElement = document.getElementById('card-errors');
                    errorElement.textContent = error.message;
                } else {
                    const response = await fetch('{{ route('payment.intent') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({
                            amount: document.getElementById('amount').value,
                            stripePaymentMethodId: paymentIntent.payment_method,
                        }),
                    });

                    const result = await response.json();

                    if (result.error) {
                        // Show error to your customer
                        console.log(result.error);
                    } else {
                        form.submit();
                    }
                }
            });
        });
    </script>
@endsection
