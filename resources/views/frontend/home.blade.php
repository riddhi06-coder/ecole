<!DOCTYPE html>
<html lang="en">
    @include('components.frontend.head')
    <style>
        .error-text{color:red;font-size:14px;margin-top:3px;display:block}
    </style>
<body>
    @include('components.frontend.header')
    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">
            <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

                <!-- Carousel items -->
                @foreach($home as $index => $banner)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="slide-wrapper">
                            <img src="{{ asset('uploads/home/' . $banner->banner_image) }}" alt="{{ $banner->alt_text ?? 'Banner Image' }}" fetchpriority="high" loading="eager">
                            <div class="slide-content">
                                <h1>IB CONTINUUM SCHOOL</h1>
                                <a class="progress-offers-custom-btn" href="{{ route('frontend.enquiry_about_admission') }}">Enquire for Admission</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Carousel controls -->
                <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev" aria-label="Previous slide">
                    <span class="carousel-control-prev-icon fa fa-angle-left" aria-hidden="true"></span>
                </a>
                
                <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next" aria-label="Next slide">
                    <span class="carousel-control-next-icon fa-angle-right" aria-hidden="true"></span>
                </a>
                
                <!-- Carousel indicators -->
                <ol class="carousel-indicators">
                    @foreach($home as $index => $banner)
                        <li data-bs-target="#hero-carousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
            </div>
        </section>
        <!-- /Hero Section -->

        <!--<section class="programmes-offer-sec">-->
        <!--    <div class="container">-->
        <!--        @if($programmes->isNotEmpty())-->
        <!--            {{-- Section title and description from the first row --}}-->
        <!--            <div class="row">-->
        <!--                <div class="col-12 col-md-12">-->
        <!--                    <h1 class="section-title-one">{{ $programmes[0]->section_title ?? 'Programmes We Offer11' }} <span></span></h1>-->
        <!--                    <p class="sub-title-one">{{ $programmes[0]->description ?? '' }}</p>-->
        <!--                </div>-->
        <!--            </div>-->

        <!--            {{-- Programmes cards --}}-->
        <!--            <div class="programmes-offer-services-sec">-->
        <!--                <div class="row">-->
        <!--                    @foreach($programmes as $programme)-->
        <!--                        <div class="col-12 col-md-4 prog-off-card-sec">-->
        <!--                            <div class="progoff-card-inner-sec">-->
        <!--                                <div class="prog-off-img-sec">-->
        <!--                                    <a href="{{ $programme->url ?? '#' }}">-->
        <!--                                        <img src="{{ asset('uploads/home/' . $programme->image) }}" alt="{{ $programme->program }}" class="img-fluid" width="334" height="223">-->
        <!--                                    </a>-->
        <!--                                </div>-->
        <!--                                <div class="prog-off-content-sec">-->
        <!--                                    <h4><a href="{{ $programme->url ?? '#' }}">{{ $programme->program }}</a></h4>-->
        <!--                                    <p><a href="{{ $programme->url ?? '#' }}">{{ $programme->program_description }}</a></p>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    @endforeach-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        @endif-->

        <!--        {{-- Static button text, dynamic URLs --}}-->
        <!--        <div class="programmes-offer-btn-sec">-->
        <!--            <div class="row">-->
        <!--                <div class="col-12 col-md-4 prog-offer-btn-sub-sec">-->
        <!--                    <a class="progress-offers-btn" target="_blank"-->
        <!--                    href="{{ $programmes[0]->url ?? '#' }}">-->
        <!--                        Schedule a Campus Tour-->
        <!--                    </a>-->
        <!--                </div>-->
        <!--                <div class="col-12 col-md-4 prog-offer-btn-sub-sec">-->
        <!--                    <a class="progress-offers-btn" target="_blank"-->
        <!--                    href="{{ $programmes[0]->url ?? '#' }}">-->
        <!--                        Download School Brochure-->
        <!--                    </a>-->
        <!--                </div>-->
        <!--                <div class="col-12 col-md-4 prog-offer-btn-sub-sec">-->
        <!--                    <a class="progress-offers-btn" target="_blank"-->
        <!--                    href="{{ $programmes[0]->url ?? '#' }}">-->
        <!--                        Speak to Admissions Advisor-->
        <!--                    </a>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
        
        <section class="programmes-offer-sec">
            <div class="container">
                @if($programmes->isNotEmpty())
                    {{-- Section title and description from the first row --}}
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <h1 class="section-title-one">
                                {{ $programmes[0]->section_title ?? 'Programmes We Offer11' }}
                                <span></span>
                            </h1>
        
                            <p class="sub-title-one">
                                {{ $programmes[0]->description ?? '' }}
                            </p>
                        </div>
                    </div>
        
                    {{-- Programmes cards --}}
                    <div class="programmes-offer-services-sec">
                        <div class="row">
        
                            @foreach($programmes as $programme)
                                <div class="col-12 col-md-4 prog-off-card-sec">
                                    <div class="progoff-card-inner-sec">
        
                                        <div class="prog-off-img-sec">
        
                                            {{-- Assign route according to programme --}}
                                            @if($loop->iteration == 1)
                                                <a href="{{ route('frontend.primary_years_programme') }}">
                                            @elseif($loop->iteration == 2)
                                                <a href="{{ route('frontend.middle_years_programme') }}">
                                            @elseif($loop->iteration == 3)
                                                <a href="{{ route('frontend.diploma_programme') }}">
                                            @endif
        
                                                <img
                                                    src="{{ asset('uploads/home/' . $programme->image) }}"
                                                    alt="{{ $programme->program }}"
                                                    class="img-fluid"
                                                    width="334"
                                                    height="223"
                                                >
        
                                            @if($loop->iteration <= 3)
                                                </a>
                                            @endif
        
                                        </div>
        
                                        <div class="prog-off-content-sec">
        
                                            {{-- Same route for programme title --}}
                                            @if($loop->iteration == 1)
                                                <h4>
                                                    <a href="{{ route('frontend.primary_years_programme') }}">
                                                        {{ $programme->program }}
                                                    </a>
                                                </h4>
        
                                                <p>
                                                    <a href="{{ route('frontend.primary_years_programme') }}">
                                                        {{ $programme->program_description }}
                                                    </a>
                                                </p>
        
                                            @elseif($loop->iteration == 2)
                                                <h4>
                                                    <a href="{{ route('frontend.middle_years_programme') }}">
                                                        {{ $programme->program }}
                                                    </a>
                                                </h4>
        
                                                <p>
                                                    <a href="{{ route('frontend.middle_years_programme') }}">
                                                        {{ $programme->program_description }}
                                                    </a>
                                                </p>
        
                                            @elseif($loop->iteration == 3)
                                                <h4>
                                                    <a href="{{ route('frontend.diploma_programme') }}">
                                                        {{ $programme->program }}
                                                    </a>
                                                </h4>
        
                                                <p>
                                                    <a href="{{ route('frontend.diploma_programme') }}">
                                                        {{ $programme->program_description }}
                                                    </a>
                                                </p>
                                            @endif
        
                                        </div>
                                    </div>
                                </div>
                            @endforeach
        
                        </div>
                    </div>
                @endif
        
                {{-- Static button text, dynamic URLs --}}
                <div class="programmes-offer-btn-sec">
                    <div class="row">
        
                        <div class="col-12 col-md-4 prog-offer-btn-sub-sec">
                            <a class="progress-offers-btn"
                               target="_blank"
                               href="{{ $programmes[0]->url ?? '#' }}">
                                Schedule a Campus Tour
                            </a>
                        </div>
        
                        <div class="col-12 col-md-4 prog-offer-btn-sub-sec">
                            <a class="progress-offers-btn"
                               target="_blank"
                               href="{{ $programmes[0]->url ?? '#' }}">
                                Download School Brochure
                            </a>
                        </div>
        
                        <div class="col-12 col-md-4 prog-offer-btn-sub-sec">
                            <a class="progress-offers-btn"
                               target="_blank"
                               href="{{ $programmes[0]->url ?? '#' }}">
                                Speak to Admissions Advisor
                            </a>
                        </div>
        
                    </div>
                </div>
            </div>
        </section>

        <section class="admissions-enquiry-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-6">
                    <div class="admission-enquiry-form-sec">
                    <div class="section-title-two">
                        <h2>Admissions Enquiry</h2>
                        <p>For any queries regarding the admission process, please fill up the form below and we will get back
                        to you as soon as possible.</p>
                    </div>
                    <form id="admissionForm" action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="form_type" value="admission">
                    
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name">
                                    <label for="name">Name *</label>
                                    <span class="error-text" id="nameError"></span>
                                </div>
                            </div>
                    
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email">
                                    <label for="email">Email *</label>
                                    <span class="error-text" id="emailError"></span>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-floating mb-3 mt-3">
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Your Phone">
                            <label for="phone">Phone Number *</label>
                            <span class="error-text" id="phoneError"></span>
                        </div>
                    
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="message" name="message" placeholder="Type Your Message" style="height: 90px"></textarea>
                            <label for="message">Message</label>
                        </div>
                        
                        <div class="row">
                            <div class="col-12 mt-3 text-center" style="margin-bottom: 10px;">
                                <div class="d-inline-block">
                                    <div class="g-recaptcha"
                                         data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                </div>
                            </div>
                        
                            <div class="col-12 text-center">
                                <span id="captchaError" class="error-text" style="color:red;"></span>
                            </div>
                        </div>
                            
                    
                        <div class="admission-euquiry-button-sec">
                            <button type="submit" class="btn-submit admission-enqu-btn">Submit</button>
                        </div>
                    </form>

                    </div>
                </div>
                </div>
            </div>
        </section>

        <!----api based---->
        <section class="alumni-section">
            <div class="container">
                <div class="section-title-two">
                    <h2>École Mondiale World School Guiding Alumni</h2>
                    <p>We are proud of our alumni who are setting an example and motivating younger students. Here are some alumni
                        who are actively guiding current students by answering questions, conducting webinars, and much more.</p>
                </div>
                <div class="alumni-slider-sec">
                    <div class="owl-carousel owl-theme alumni-carousal-slide">
                        @if(!empty($alumniData['success']) && !empty($alumniData['data']))
                            @foreach($alumniData['data'] as $alumnus)
                            <div class="alumni-card">
                                <div class="alumni-card-upper-sec">
                                    <img src="{{ $alumnus['image_path'] }}" alt="{{ $alumnus['full_name'] }}" class="img-fluid" width="78" height="78">
                                    <h5>{{ $alumnus['full_name'] }}</h5>
                                </div>
                                <hr>
                                <div class="alumni-card-lower-sec">
                                    <ul>
                                        <li><i class="college"></i> 
                                            <span>{{ $alumnus['campus_name'] }}, Batch {{ $alumnus['pass_out_year'] }}</span>
                                        </li>
                                        <li><i class="tool"></i> <span>{{ $alumnus['department'] }}</span></li>
                                        <li><i class="cap"></i> <span>{{ $alumnus['institue_name'] }}</span></li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <p>No alumni data available at the moment.</p>
                        @endif
                    </div>

                </div>

                <div class="alumni-uni-sec">
                    <div class="other_links_wrap">
                        <div class="other_links">
                            <h4 class="text-white">Alumni Guidance</h4>
                            <a class="btn-signUp" href="{{ route('frontend.alumni_guidance') }}">Know More</a>
                        </div>
                        <div class="other_links">
                            <h4 class="text-white">Success Stories</h4>
                            <a class="btn-signUp" href="{{ route('frontend.success_stories') }}">Know More</a>
                        </div>
                    </div>
                    <div class="powerBy justify-content-center">
                        <span class="text-white">Powered by</span>
                        <a href="https://univariety.com/" target="_blank"><img
                                src="{{ asset('frontend/assets/img/icons/univariety-white-logo.svg') }}" alt="Univariety Logo" class="img-fluid" width="180" height="37" /></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="latest-blog-one-sec">
            <div class="container">
                <div class="latest-blog-carousel owl-carousel owl-theme">
                    @foreach($festivities as $festivity)
                        <div class="item">
                            <div class="lblo-card-sec">
                                <div class="row">
                                    <div class="col-12 col-md-5">
                                        <div class="la-blo-img-sec">
                                            <img src="{{ asset('uploads/home/festivities/' . $festivity->image) }}" 
                                                alt="{{ $festivity->heading }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-7">
                                        <div class="latest-blog-content-sec">
                                            <h4>{{ $festivity->heading }}</h4>
                                            <p>{!! $festivity->description !!}</p>
                                            <div class="latest-blog-btn-sec">
                                                @php
                                                    $url = trim($festivity->url ?? '');
                               
                                                @endphp
                                            
                                                @if($url && $url !== 'javascript:void(0)')
                                                    <a href="{{ $url }}"
                                                       target="_blank"
                                                       class="yellow-btn">
                                                        Read More
                                                        <span class="sr-only-custom">
                                                            about {{ $festivity->heading }}
                                                        </span>
                                                    </a>
                                                @else
                                                    <button type="button" class="yellow-btn">
                                                        Read More
                                                        <span class="sr-only-custom">
                                                            about {{ $festivity->heading }}
                                                        </span>
                                                    </button>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="ratio-policy-sec">

            <div class="container">
                @foreach($features as $featureSection)
                    <div class="row mb-4">
                        <div class="col-12 col-md-12">
                            <p>{!! $featureSection->description !!}</p>
                        </div>
                    </div>

                    <div class="ratio-policy-content-sec">
                        <div class="row">
                            @php
                                $featureItems = json_decode($featureSection->features, true);
                            @endphp

                            @if(!empty($featureItems))
                                @foreach($featureItems as $item)
                                <div class="col-md-3 col-sm-6 col-lg-3 col-xl-3 rp-c-box text-center mb-4">
                                    <img src="{{ asset('uploads/home/features/' . $item['image']) }}" alt="{{ $item['name'] }}" width="190" height="190" class="img-fluid">
                                    <h4>{{ $item['name'] }}</h4>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="bullet-board-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <h1 class="section-title-one">
                            {{ $bulletin->first()->section_title ?? 'Bulletin' }} <span></span>
                        </h1>
                        <p class="sub-title-one">
                            {{ $bulletin->first()->description ?? 'Catch up with the latest as well as upcoming activities that the students of École Mondiale World School are up to.' }}
                        </p>
                    </div>
                </div>

                <div class="programmes-offer-services-sec ">
                    <div class="row">
                        @foreach($bulletin as $item)
                            <div class="col-12 col-md-4 bullet-board-card-sec">
                                <div class="bullet-board-card-inner-sec">
                                    <div class="bullet-board-img-sec">
                                        @if($item->thumbnail_image)
                                                {{-- Show Image --}}
                                                <img class="bb-img-main"
                                                     src="{{ asset('uploads/bulletin/' . $item->thumbnail_image) }}"
                                                     alt="{{ $item->article_name }}">
                                        @elseif($item->thumbnail_video)
                                            {{-- Show Video --}}
                                            <video class="bb-img-main" autoplay muted loop playsinline
                                                   style="width: 100%; height: auto; border-radius: 8px; object-fit: cover;">
                                                <source src="{{ asset('uploads/bulletin/videos/' . $item->thumbnail_video) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @else
                                            {{-- Fallback Default Image --}}
                                            <img class="bb-img-main"
                                                 src="{{ asset('uploads/bulletin/default.webp') }}"
                                                 alt="{{ $item->article_name }}">
                                        @endif
                                    </div>
                                    <div class="bullet-board-content-sec">
                                        <h4>
                                            <a href="{{ $item->url }}" target="_blank">{{ $item->article_name }}</a>
                                        </h4>
                                        <p>
                                            <a href="{{ $item->url }}" target="_blank">
                                                {{ \Illuminate\Support\Str::limit($item->short_desc, 150, '...') }}
                                            </a>
                                        </p>
                                        <div class="bullet-board-btn-sec">
                                            <a href="{{ $item->url }}" target="_blank" class="btn-ecol btn">Read More <span class="sr-only-custom">about {{ $item->article_name }}</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="emc-testimonials-sec">
            <div class="container">
                <div class="owl-carousel owl-theme emctesti-carousel">
                    @foreach($testimonials as $testimonial)
                        <div class="item">
                            <div class="review-card">
                                <p class="review-text">
                                    @if(!empty($testimonial->url))
                                        <a href="{{ $testimonial->url }}" target="_blank">
                                            {{ $testimonial->description }}
                                        </a>
                                    @else
                                        {{ $testimonial->description }}
                                    @endif
                                </p>
                                <div class="review-footer">
                                    <div class="review-meta">
                                        <h6>{{ $testimonial->reviewer }}</h6>
                                        <small>{{ $testimonial->reviewer_details }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="client-section py-5 bg-light">
            <div class="container">
                <div class="owl-carousel owl-theme client-carousel">
                    @foreach($clients as $clientGroup)
                        @php
                            $clientImages = json_decode($clientGroup->clients, true);
                        @endphp

                        @if(!empty($clientImages))
                            @foreach($clientImages as $client)
                                <div class="item">
                                    <div class="client-logo">
                                        <img src="{{ asset('uploads/home/' . $client['image']) }}" 
                                            alt="Client" class="img-fluid" width="149" height="90">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

    </main>


    @include('components.frontend.footer')

    @include('components.frontend.main-js')
    <!--<script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
    <script>
document.addEventListener('DOMContentLoaded', function() {

    let recaptchaLoaded = false;

    function loadRecaptcha() {
        if (!recaptchaLoaded) {
            const script = document.createElement('script');
            script.src = 'https://www.google.com/recaptcha/api.js';
            script.async = true;
            script.defer = true;
            document.body.appendChild(script);
            recaptchaLoaded = true;
        }
    }

    const form = document.getElementById('admissionForm');
    if (!form) return;

    // Lazy-load CAPTCHA on first focus inside the form
    form.addEventListener('focusin', loadRecaptcha);
    // Optional: also load on hover
    form.addEventListener('mouseover', loadRecaptcha);

    form.addEventListener('submit', function(e) {
        document.querySelectorAll('.error-text').forEach(el => el.textContent = "");

        let name = document.getElementById('name').value.trim();
        let email = document.getElementById('email').value.trim();
        let phone = document.getElementById('phone').value.trim();

        let nameRegex = /^[A-Za-z\s]+$/;
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let phoneRegex = /^[0-9]{10,15}$/;

        let isValid = true;

        if (!nameRegex.test(name)) {
            document.getElementById('nameError').textContent = "Enter a valid name (only letters).";
            isValid = false;
        }

        if (!emailRegex.test(email)) {
            document.getElementById('emailError').textContent = "Enter a valid email address.";
            isValid = false;
        }

        if (!phoneRegex.test(phone)) {
            document.getElementById('phoneError').textContent = "Enter valid 10–15 digit phone.";
            isValid = false;
        }

        // ---------- CAPTCHA VALIDATION ----------
        let captchaResponse = typeof grecaptcha !== "undefined" ? grecaptcha.getResponse() : "";
        if (captchaResponse.length === 0) {
            let captchaError = document.getElementById('captchaError');
            if (captchaError) {
                captchaError.textContent = "Please verify that you are not a robot.";
            }
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        } else {
            const submitBtn = document.querySelector('.admission-enqu-btn');
            submitBtn.disabled = true;
            submitBtn.textContent = "Submitting...";
            submitBtn.style.opacity = "0.7";
            submitBtn.style.cursor = "not-allowed";
        }
    });
});
</script>



</body>
</html>