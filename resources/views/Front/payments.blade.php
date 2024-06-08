<x-front-layout title="payment">
    <x-slot name="breadcrumb">
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="{{ route('front.products.index') }}"> Cart </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container">
        <h1>Pay with Stripe</h1>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <!-- Display a payment form -->
                <div id="payment-message" class="mt-2 alert alert-info d-none" role="alert" style="display: none;">
                </div>
                <form id="payment-form" method="POST" action="">
                    @csrf
                    <div id="payment-element" class="mb-3">
                        <!--Stripe.js injects the Payment Element-->
                    </div>
                    <button id="submit" type="submit" class="btn btn-primary">
                        <div class="spinner-border spinner-border-sm" id="spinner" role="status"
                            style="display: none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <span id="button-text">Pay now</span>
                    </button>

                </form>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const stripe = Stripe("{{ config('services.stripe.public') }}");

            let elements;
            let clientSecret;

            initialize();

            async function initialize() {
                try {
                    const response = await fetch("{{ route('payments.store', $order->id) }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            _token: "{{ csrf_token() }}"
                        }),
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();

                    if (data.error) {
                        console.error('Error:', data.error);
                        showMessage(data.error);
                        return;
                    }

                    clientSecret = data.client_secret;

                    // Initialize elements with the clientSecret
                    elements = stripe.elements({
                        clientSecret
                    });

                    const paymentElementOptions = {
                        layout: "tabs",
                    };
                    const paymentElement = elements.create('payment', paymentElementOptions);
                    paymentElement.mount("#payment-element");
                } catch (error) {
                    console.error('Error:', error);
                    showMessage('An error occurred while initializing payment.');
                }
            }

            document.querySelector("#payment-form").addEventListener("submit", handleSubmit);

            async function handleSubmit(event) {
                event.preventDefault();
                setLoading(true);

                try {
                    const {
                        error,
                        paymentIntent
                    } = await stripe.confirmPayment({
                        elements,
                        confirmParams: {
                            return_url: "{{ route('stripe.return', $order->id) }}",
                        },
                    });

                    if (error) {
                        showMessage(error.message);
                        setLoading(false);
                        return;
                    }

                    if (paymentIntent.status === 'succeeded') {
                        window.location.href = "{{ route('stripe.return', $order->id) }}";
                    } else {
                        showMessage('Payment processing...');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showMessage('An error occurred while processing payment.');
                }

                setLoading(false);
            }

            function setLoading(isLoading) {
                if (isLoading) {
                    document.querySelector("#submit").disabled = true;
                    document.querySelector("#spinner").style.display = "block";
                    document.querySelector("#button-text").style.display = "none";
                } else {
                    document.querySelector("#submit").disabled = false;
                    document.querySelector("#spinner").style.display = "none";
                    document.querySelector("#button-text").style.display = "block";
                }
            }

            function showMessage(messageText) {
                const messageContainer = document.querySelector("#payment-message");
                messageContainer.classList.remove("hidden");
                messageContainer.textContent = messageText;
                setTimeout(() => {
                    messageContainer.classList.add("hidden");
                    messageContainer.textContent = "";
                }, 4000);
            }
        });
    </script>
</x-front-layout>
