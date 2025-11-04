<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')



    <main class="main">

        <section class="thank-you-apart-sec">
        <div class="container">
            <div class="row">
            <div class="col-12 col-md-12">
                <div class="thank-you-img-sec">
                <img src="{{ asset('frontend/assets/img/icons/thank-you-img-ecol.png') }}" class="img-fluid" alt="Thank You Image">
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="thank-you-content-sec">
                <h4 class="thank-you-title">Thank You</h4>
                <p>We appreciate your trust in our services. For any inquiries or updates, please feel free to contact us.</p>
                </div>
            </div>
            <div class="col-12 col-md-4 thank-you-btn-sec prog-offer-btn-sub-sec">
                <a class="progress-offers-btn" target="_blank"
                href="{{ route('frontend.index') }}">Back To Home</a>
            </div>
            </div>
        </div>
        </section>

    </main>

    @include('components.frontend.footer')

    @include('components.frontend.main-js')


</body>
</html>