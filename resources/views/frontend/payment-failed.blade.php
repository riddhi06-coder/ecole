<!DOCTYPE html>
<html lang="en">

@include('components.frontend.head')

<body>

@include('components.frontend.header')

<div class="container py-5">
    <div class="text-center my-4">

        <h2 class="text-danger fw-bold mb-3">Payment Failed!</h2>
        <p class="text-muted mb-4">
            Unfortunately, your payment could not be processed.
        </p>

        <div class="card mx-auto shadow-sm" style="max-width: 500px;">
            <div class="card-body text-start">

                <h5 class="mb-3 text-center">Transaction Details</h5>

                <p><strong>Order ID:</strong> {{ $responseArray['order_id'] ?? 'NA' }}</p>
                <p><strong>Status:</strong> {{ $responseArray['order_status'] ?? 'Failed' }}</p>
                <p><strong>Tracking ID:</strong> {{ $responseArray['tracking_id'] ?? 'NA' }}</p>
                <p><strong>Bank Ref No:</strong> {{ $responseArray['bank_ref_no'] ?? 'NA' }}</p>
                <p><strong>Payment Mode:</strong> {{ $responseArray['payment_mode'] ?? 'NA' }}</p>
                <p><strong>Failure Reason:</strong>
                    {{ $responseArray['failure_message'] ?? $responseArray['status_message'] ?? 'Payment was unsuccessful' }}
                </p>

            </div>
        </div>

        <a href="{{ route('frontend.apply_for_admission') }}" class="btn btn-outline-danger mt-4">
            Go Back
        </a>

    </div>
</div>

@include('components.frontend.footer')
@include('components.frontend.main-js')

</body>
</html>
