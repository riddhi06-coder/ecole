<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

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
                                    <a href="tel:{{ $contact_us->contact_number }}">
                                        {{ $contact_us->contact_number }}
                                    </a>
                                </p>
                                <p>
                                    <a href="tel:{{ $contact_us->other_contact_number }}">
                                        {{ $contact_us->other_contact_number }}
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
                        <form>
                        <div class="contact-form-input-sec">
                            <input type="text" class="form-control" id="name" placeholder="Enter Name" required>
                        </div>
                        <div class="contact-form-input-sec">
                            <input type="email" class="form-control" id="email" placeholder="Enter Email" required>
                        </div>
                        <div class="contact-form-input-sec">
                            <input type="tel" class="form-control" id="phone" placeholder="Enter Phone number" required>
                        </div>
                        <div class="contact-form-input-sec">
                            <select class="form-select" id="enquiry" required>
                            <option value="">Type of Enquiry*</option>
                            <option value="general-enquiry">General Enquiry</option>
                            <option value="employment-enquiry">Employment Enquiry</option>
                            <option value="admission-enquiry">Admission Enquiry</option>
                            </select>
                        </div>
                        <div class="contact-form-input-sec">
                            <textarea class="form-control" id="message" rows="4" placeholder="Message"></textarea>
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


</body>
</html>