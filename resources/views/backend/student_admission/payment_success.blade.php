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
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="thank-you-img-sec1">
                            <img src="{{ asset('frontend/assets/img/icons/check.png') }}" class="img-fluid" alt="Payment Successful">
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="thank-you-content-sec text-center">
                            <h4 class="thank-you-title">Payment Successful!</h4>
                            <p class="mt-5">Thank you for your payment. Your transaction has been successfully processed and initimation for the same will be shared on mail.</p>
                            <p>If you have any questions or need assistance, feel free to reach out to us. We’re always happy to help!</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 thank-you-btn-sec prog-offer-btn-sub-sec">
                        <a class="progress-offers-btn" target="_blank" href="{{ route('frontend.index') }}">Back to Home</a>
                    </div>
                </div>
            </div>
        </section>
    
    </main>


    @include('components.frontend.footer')

    @include('components.frontend.main-js')


</body>
</html>