<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')
    
    <style>
        .thank-you-img-sec1,
        .thank-you-content-sec1,
        .thank-you-btn-sec1 {
            text-align: center;
        }
        
        .thank-you-apart-sec1 .row {
            justify-content: center;
        }
        
        .thank-you-img-sec1 img {
            width: 200px;
        }

    </style>

<body>

    @include('components.frontend.header')



    <main class="main">
        <section class="thank-you-apart-sec">
            <div class="container text-center">
                <div class="col-12 col-md-12">
                    <div class="thank-you-img-sec1">
                        <img src="{{ asset('frontend/assets/img/icons/cancel.png') }}" class="img-fluid" alt="Payment Failed">
                    </div>
                </div>
                <h4 class="thank-you-title text-danger mt-5">Payment Failed</h4>
                <p>Oops! Your payment could not be processed.</p>
                <p>Please try again or contact support for assistance.</p>
                <div class="d-flex justify-content-center gap-3 mt-3">
                    <a href="{{ route('razorpay.checkout', $payment->payment_reference_id) }}"
                       class="progress-offers-btn"
                       target="_blank">
                        Try Again
                    </a>
                    
                    <a href="{{ route('frontend.index') }}"
                       class="progress-offers-btn"
                       target="_blank">
                        Back to Home
                    </a>

                </div>

            </div>
        </section>
    </main>



    @include('components.frontend.footer')

    @include('components.frontend.main-js')


</body>
</html>