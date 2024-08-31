<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}');
    const elements = stripe.elements();

    // Create an instance of the card Element.
    const card = elements.create('card');

    // Add an instance of the card Element into the `card-element` div.
    card.mount('#card-element');

    // Handle form submission.
    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        // Create a payment method using the card Element.
        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: card,
        });

        if (error) {
            // Display error message to the user.
            const errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
        } else {
            // If no errors, token should be sent to your server.
            stripeTokenHandler(paymentMethod);
        }
    });

    // Send the payment method ID to your server to complete the payment.
    const stripeTokenHandler = async (paymentMethod) => {
        const token = paymentMethod.id;

        // Submit the form with the token ID to your Laravel controller.
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('payment_method_id', token);

        const response = await fetch('{{ route('processPayment') }}', {
            method: 'POST',
            body: formData,
        });

        // Handle the response, e.g., show success or error message.
    };
</script>
