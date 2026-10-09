<script>
console.log('Blade Razorpay Order ID:', "{{ $payment->razorpay_order_id }}");
</script>


<!-- Loader -->
<div id="payment-loader"
     style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
     background:rgba(255,255,255,0.8); z-index:9999; text-align:center;">
    <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);">
        <div class="spinner"></div>
        <p>Processing payment, please wait...</p>
    </div>
</div>

<style>
.spinner {
    border: 8px solid #f3f3f3;
    border-top: 8px solid #528FF0;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    margin-left: 60px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const razorpayOrderId = "{{ $payment->razorpay_order_id }}";

    if (!razorpayOrderId) {
        alert('Razorpay order not initialized. Please refresh the page.');
        return;
    }

    var options = {
        key: "{{ config('services.razorpay.key') }}",
        amount: {{ $payment->selected_amount * 100 }},
        currency: "INR",
        name: "Ecole Mondiale World School",
        description: "Student Fee Payment",
        order_id: razorpayOrderId,

        handler: function (response) {

            console.log('Razorpay response:', response);

            if (
                !response.razorpay_payment_id ||
                !response.razorpay_order_id ||
                !response.razorpay_signature
            ) {
                alert('Payment verification failed. Please contact support.');
                window.location.href = "{{ route('payment.failed.page', $payment->payment_reference_id) }}";
                return;
            }

            document.getElementById('payment-loader').style.display = 'block';

            fetch("{{ route('razorpay.capture') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: new URLSearchParams({
                    payment_reference_id: "{{ $payment->payment_reference_id }}",
                    razorpay_payment_id: response.razorpay_payment_id,
                    razorpay_order_id: response.razorpay_order_id,
                    razorpay_signature: response.razorpay_signature
                })
            })
            .then(res => res.json())
            .then(data => {
                window.location.href = data.success
                    ? data.redirect_url
                    : "{{ route('payment.failed.page', $payment->payment_reference_id) }}";
            })
            .catch(() => {
                window.location.href = "{{ route('payment.failed.page', $payment->payment_reference_id) }}";
            });
        }
    };

    new Razorpay(options).open();
});
</script>





