<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')
    
    <style>
        .error-text {
            color: red;
            font-size: 14px;
            margin-top: 3px;
            display: block;
        }
    </style>

<body>

    @include('components.frontend.header')


    <main class="main">


        <section class="ecolemon-breadcrumb-sec ecol-contact-breadcrumb-sec"  style="background-image: url('{{ asset('uploads/contact/'.$contact_us->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center; 
                   ">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1> {{  $contact_us->banner_heading ? $contact_us->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                    <!-- <li><a href="javascript:void(0)">Campus life<i class="fa fa-angle-right"></i></a></li> -->
                    <li class="active"><a href="javascript:void(0)"> {{  $contact_us->banner_heading ? $contact_us->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>


        <section class="contact-us-one-sec">
            <div class="container">
                <div class="row">
                    {{-- Phone --}}
                    <div class="col-12 col-md-4">
                        <div class="contact-us-cpe-sec">
                            <div class="cont-cpe-img-sec">
                                <img src="{{ asset('frontend/assets/img/icons/call.webp') }}" alt="Phone">
                            </div>
                            <div class="cont-content-sec">
                                <h4>Phone</h4>
                                <p>
                                    <a href="tel:+91{{ $contact_us->contact_number }}">
                                        +91 {{ $contact_us->contact_number }}
                                    </a>
                                </p>
                                <p>
                                    <a href="tel:+91{{ $contact_us->other_contact_number }}">
                                        +91 {{ $contact_us->other_contact_number }}
                                    </a> 
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="col-12 col-md-4">
                        <div class="contact-us-cpe-sec">
                            <div class="cont-cpe-img-sec">
                                <img src="{{ asset('frontend/assets/img/icons/email.webp') }}" alt="Email">
                            </div>
                            <div class="cont-content-sec">
                                <h4>Email</h4>
                                <p>
                                    <a href="mailto:{{ $contact_us->email }}">
                                        {{ $contact_us->email }}
                                    </a>
                                </p>
                                <p>
                                    <a href="mailto:{{ $contact_us->other_email }}">
                                        {{ $contact_us->other_email }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Address --}}
                    <div class="col-12 col-md-4">
                        <div class="contact-us-cpe-sec">
                            <div class="cont-cpe-img-sec">
                                <img src="{{ asset('frontend/assets/img/icons/address.webp') }}" alt="Address">
                            </div>
                            <div class="cont-content-sec">
                                <h4>Address</h4>
                                <p>
                                    <a href="{{ $contact_us->map_url }}" target="_blank">
                                        {{ $contact_us->address }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="contact-us-form-sec">
            <div class="container">
                <div class="contact-us-form-wrap">
                <div class="row">
                    <div class="col-12 col-md-6">
                    <div class="contact-us-img-sec">
                        <img src="{{ asset('frontend/assets/img/about-us/school-calendar-img.webp') }}" alt="">
                    </div>
                    </div>
                    <div class="col-12 col-md-6">
                    <div class="contact-form-inner-sec">
                        <h4 class="bb-sidebar-title">Leave a message/Enquiry</h4>
                        <p>If you have any questions for us, please fill up the form below and we will get back to you as soon
                        as
                        possible.</p>
                        
                        <form id="contactForm" action="{{ route('contact.store') }}" method="POST">
                            @csrf
                        
                           
                            <input type="hidden" name="form_type" value="contact">
                            
                            <div class="contact-form-input-sec">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name*">
                                <span class="error-text" id="nameError"></span>
                            </div>
                        
                            <div class="contact-form-input-sec">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email*">
                                <span class="error-text" id="emailError"></span>
                            </div>
                        
                            <div class="contact-form-input-sec">
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Phone number*">
                                <span class="error-text" id="phoneError"></span>
                            </div>
                                <input type="hidden" id="utm" name="utm">
                                <div class="contact-form-input-sec">
                                <select class="form-select" id="enquiry" name="enquiry_type">
                                    <option value="">Type of Enquiry*</option>
                                    <option value="General">General Enquiry</option>
                                    <option value="Employment">Employment Enquiry</option>
                                    <option value="Admission">Admission Enquiry</option>
                                </select>
                                <span class="error-text" id="enquiryError"></span>
                            </div>
                        
                            <div class="contact-form-input-sec">
                                <textarea class="form-control" id="message" name="message" rows="4" placeholder="Message"></textarea>
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

                    
                        
                            <div class="contact-form-btn-sec">
                                <button type="submit" class="contact-form-btn">Submit</button>
                            </div>
                        </form>

                        
                    </div>
                    </div>
                </div>
                </div>

            </div>
        </section>

        <section class="contact-us-two-map-sec">
            @if(!empty($contact_us->i_frame))
                {!! $contact_us->i_frame !!}
            @else
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3769.8675958360695!2d72.83147657093998!3d19.113463617222116!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c9c482bbe715%3A0xbb11487687019aec!2sEcole+Mondiale+World+School!5e0!3m2!1sen!2sin!4v1552368669624"
                    style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            @endif
        </section>

    </main>

    @include('components.frontend.footer')

    @include('components.frontend.main-js')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


    <script>
    
    
        document.getElementById('contactForm').addEventListener('submit', function (e) {
        
            document.querySelectorAll('.error-text').forEach(el => el.textContent = "");
        
            let name = document.getElementById('name').value.trim();
            let email = document.getElementById('email').value.trim();
            let phone = document.getElementById('phone').value.trim();
            let enquiry = document.getElementById('enquiry').value.trim();
        
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
        
            if (enquiry === "") {
                document.getElementById('enquiryError').textContent = "Please select enquiry type.";
                isValid = false;
            }
            
             /* ---------- CAPTCHA VALIDATION ---------- */
            let captchaResponse = grecaptcha.getResponse();
        
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
                // Disable Button & Change Text
                const submitBtn = document.querySelector('.contact-form-btn');
                submitBtn.disabled = true;
                submitBtn.textContent = "Submitting...";
                submitBtn.style.opacity = "0.7";
                submitBtn.style.cursor = "not-allowed";
            }
        });
    </script>


<script>
document.addEventListener("DOMContentLoaded", function () {

    const params = new URLSearchParams(window.location.search);

    const utm_source   = params.get("utm_source")   || "";
    const utm_medium   = params.get("utm_medium")   || "";
    const utm_campaign = params.get("utm_campaign") || "";
    const utm_term     = params.get("utm_term")     || "";
    const utm_content  = params.get("utm_content")  || "";

    let utmString = 
        "utm_source=" + utm_source +
        "&utm_medium=" + utm_medium +
        "&utm_campaign=" + utm_campaign +
        "&utm_term=" + utm_term +
        "&utm_content=" + utm_content;

    document.getElementById("utm").value = utmString;

});
</script></body>
</html>