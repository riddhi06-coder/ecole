<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">
            <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
                
                @foreach($home as $index => $banner)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ asset('uploads/home/' . $banner->banner_image) }}" alt="{{ $banner->alt_text ?? '' }}">
                    </div>
                @endforeach

                <!-- Carousel controls -->
                <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
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

   
        <section class="programmes-offer-sec">
            <div class="container">
                @if($programmes->isNotEmpty())
                    {{-- Section title and description from the first row --}}
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <h1 class="section-title-one">{{ $programmes[0]->section_title ?? 'Programmes We Offer11' }} <span></span></h1>
                            <p class="sub-title-one">{{ $programmes[0]->description ?? '' }}</p>
                        </div>
                    </div>

                    {{-- Programmes cards --}}
                    <div class="programmes-offer-services-sec">
                        <div class="row">
                            @foreach($programmes as $programme)
                                <div class="col-12 col-md-4 prog-off-card-sec">
                                    <div class="progoff-card-inner-sec">
                                        <div class="prog-off-img-sec">
                                            <a href="{{ $programme->url ?? '#' }}">
                                                <img src="{{ asset('uploads/home/' . $programme->image) }}" alt="{{ $programme->program }}">
                                            </a>
                                        </div>
                                        <div class="prog-off-content-sec">
                                            <h4><a href="{{ $programme->url ?? '#' }}">{{ $programme->program }}</a></h4>
                                            <p><a href="{{ $programme->url ?? '#' }}">{{ $programme->program_description }}</a></p>
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
                            <a class="progress-offers-btn" target="_blank"
                            href="{{ $programmes[0]->url ?? '#' }}">
                                Schedule a Campus Tour
                            </a>
                        </div>
                        <div class="col-12 col-md-4 prog-offer-btn-sub-sec">
                            <a class="progress-offers-btn" target="_blank"
                            href="{{ $programmes[0]->url ?? '#' }}">
                                Download School Brochure (PDF)
                            </a>
                        </div>
                        <div class="col-12 col-md-4 prog-offer-btn-sub-sec">
                            <a class="progress-offers-btn" target="_blank"
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
                <form>
                    <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                        <input type="text" class="form-control" id="name" placeholder="Enter Your Name" required>
                        <label for="name">Name *</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                        <input type="email" class="form-control" id="email" placeholder="Enter Your Email" required>
                        <label for="email">Email *</label>
                        </div>
                    </div>
                    </div>

                    <div class="form-floating mb-3 mt-3">
                    <input type="tel" class="form-control" id="phone" placeholder="Enter Your Phone" required>
                    <label for="phone">Phone Number *</label>
                    </div>

                    <div class="form-floating mb-3">
                    <textarea class="form-control" id="message" placeholder="Type Your Message"
                        style="height: 90px"></textarea>
                    <label for="message">Message</label>
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
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/1.jpg" alt="Gauri Kanade">
                    <h5>Suveer Katariya</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2010</span></li>
                    <li><i class="tool"></i> <span>Business Management</span></li>
                    <li><i class="cap"></i> <span>University of Miami</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/2.jpg" alt="Gauri Kanade">
                    <h5>Aman Kothari</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2016</span></li>
                    <li><i class="tool"></i> <span>Business Management</span></li>
                    <li><i class="cap"></i> <span>Boston University</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/3.jpg" alt="Gauri Kanade">
                    <h5>Gauri Kanade</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2016</span></li>
                    <li><i class="tool"></i> <span>Humanities</span></li>
                    <li><i class="cap"></i> <span>Rollins College</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/4.jpg" alt="Gauri Kanade">
                    <h5>Aalika Shah</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2011</span></li>
                    <li><i class="tool"></i> <span>Business Management</span></li>
                    <li><i class="cap"></i> <span>Boston University</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/5.jpg" alt="Gauri Kanade">
                    <h5>Nishka Kapur</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2013</span></li>
                    <li><i class="tool"></i> <span>Fashion</span></li>
                    <li><i class="cap"></i> <span>Fashion Institute of Design and Merchandising</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/6.png" alt="Gauri Kanade">
                    <h5>Aarohi Agrawal</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2024</span></li>
                    <li><i class="tool"></i> <span>Computer Science &amp; Information Technology</span></li>
                    <li><i class="cap"></i> <span>University of Massachusetts Amherst</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/7.jpg" alt="Gauri Kanade">
                    <h5>Kanav Kothari</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2018</span></li>
                    <li><i class="tool"></i> <span>Law</span></li>
                    <li><i class="cap"></i> <span>King's College London</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/8.jpg" alt="Gauri Kanade">
                    <h5>Ishika Sumit Agarwal</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2020</span></li>
                    <li><i class="tool"></i> <span>Business Management</span></li>
                    <li><i class="cap"></i> <span>Narsee Monjee Institute of Management Studies, Mumbai</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/9.jpg" alt="Gauri Kanade">
                    <h5>Dhrish Jain</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2020</span></li>
                    <li><i class="tool"></i> <span>Business Management</span></li>
                    <li><i class="cap"></i> <span>Babson College</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/10.png" alt="Gauri Kanade">
                    <h5>Krttika Goel</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2021</span></li>
                    <li><i class="tool"></i> <span>Engineering &amp; Technology</span></li>
                    <li><i class="cap"></i> <span>Purdue University - Main Campus</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/11.png" alt="Gauri Kanade">
                    <h5>Pratham Lohia</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2022</span></li>
                    <li><i class="tool"></i> <span>Engineering &amp; Technology</span></li>
                    <li><i class="cap"></i> <span>Middlesex University London</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/12.jpg" alt="Gauri Kanade">
                    <h5>Zara Sharma</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2024</span></li>
                    <li><i class="tool"></i> <span>Business Management</span></li>
                    <li><i class="cap"></i> <span>University Of Edinburgh</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/13.jpg" alt="Gauri Kanade">
                    <h5>Nishika Jethra</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2024</span></li>
                    <li><i class="tool"></i> <span>Engineering &amp; Technology</span></li>
                    <li><i class="cap"></i> <span>University of Illinois at Urbana-Champaign</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/14.jpg" alt="Gauri Kanade">
                    <h5>Ansh Suri</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2022</span></li>
                    <li><i class="tool"></i> <span>Business Management</span></li>
                    <li><i class="cap"></i> <span>San Diego State University</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/15.jpg" alt="Gauri Kanade">
                    <h5>Aaryaveer Somani</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2022</span></li>
                    <li><i class="tool"></i> <span>Economics &amp; Commerce</span></li>
                    <li><i class="cap"></i> <span>Purdue University - Main Campus</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/16.jpg" alt="Gauri Kanade">
                    <h5>Rhushi Shah</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2015</span></li>
                    <li><i class="tool"></i> <span>Economics &amp; Commerce</span></li>
                    <li><i class="cap"></i> <span>University Of London</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/17.jpg" alt="Gauri Kanade">
                    <h5>Vedant Kothari</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2020</span></li>
                    <li><i class="tool"></i> <span>Engineering &amp; Technology</span></li>
                    <li><i class="cap"></i> <span>King's College London</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/18.jpg" alt="Gauri Kanade">
                    <h5>Alyce Christiansen</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2014</span></li>
                    <li><i class="tool"></i> <span>Journalism, Media, PR &amp; Communication</span></li>
                    <li><i class="cap"></i> <span>Queensland University of Technology (Gardens Point Campus)</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/19.jpg" alt="Gauri Kanade">
                    <h5>Udit Dedhiya</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2015</span></li>
                    <li><i class="tool"></i> <span>Law</span></li>
                    <li><i class="cap"></i> <span>Jindal Global Law School</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/20.jpg" alt="Gauri Kanade">
                    <h5>Mihir Parekh</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2009</span></li>
                    <li><i class="tool"></i> <span>Engineering &amp; Technology</span></li>
                    <li><i class="cap"></i> <span>University Of Warwick</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/21.jpg" alt="Gauri Kanade">
                    <h5>Vihaan Kohli</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2017</span></li>
                    <li><i class="tool"></i> <span>Business Management</span></li>
                    <!-- <li><i class="cap"></i> <span></span></li> -->
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/22.jpg" alt="Gauri Kanade">
                    <h5>Ahan Rajgor</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2016</span></li>
                    <li><i class="tool"></i> <span>Business Management</span></li>
                    <li><i class="cap"></i> <span>Rollins College</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/23.jpg" alt="Gauri Kanade">
                    <h5>Sawan Bhandari</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2018</span></li>
                    <li><i class="tool"></i> <span>Business Management</span></li>
                    <li><i class="cap"></i> <span>University of Southern California</span></li>
                    </ul>
                </div>
                </div>
                <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                    <img src="./assets/img/alumni/24.jpg" alt="Gauri Kanade">
                    <h5>Yash Mandloi</h5>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                    <ul>
                    <li><i class="college"></i> <span>Ecole Mondiale World School, Mumbai, Batch 2024</span></li>
                    <li><i class="tool"></i> <span>Economics &amp; Commerce</span></li>
                    <li><i class="cap"></i> <span>Tufts University</span></li>
                    </ul>
                </div>
                </div>
            </div>
            </div>

            <div class="alumni-uni-sec">
            <div class="other_links_wrap">
                <div class="other_links">
                <h4 class="text-white">Alumni Guidance</h4>
                <a class="btn-signUp" href="https://www.ecolemondiale.org/alumni-guidance">Know More</a>
                </div>
                <div class="other_links">
                <h4 class="text-white">Success Stories</h4>
                <a class="btn-signUp" href="https://www.ecolemondiale.org/success-stories">Know More</a>
                </div>
            </div>
            <div class="powerBy justify-content-center">
                <span class="text-white">Powered by</span>
                <a href="https://univariety.com/" target="_blank"><img
                    src="./assets/img/icons/univariety-white-logo.svg" /></a>
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
                                <div class="col-12 col-md-4">
                                    <div class="la-blo-img-sec">
                                        <img src="{{ asset('uploads/home/festivities/' . $festivity->image) }}" 
                                            alt="{{ $festivity->heading }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="latest-blog-content-sec">
                                        <h4>{{ $festivity->heading }}</h4>
                                        <p>{{ $festivity->description }}</p>
                                        <div class="latest-blog-btn-sec">
                                            <a href="#" target="_blank" class="yellow-btn">Read More</a>
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

        <section class="ratio-policy-sec" 
                @if(!empty($features[0]->image)) 
                    style="background-image: url('{{ asset('uploads/home/features/' . $features[0]->image) }}'); background-size: cover; background-position: center;"
                @endif>

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
                                    <img src="{{ asset('uploads/home/features/' . $item['image']) }}" alt="{{ $item['name'] }}">
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

                <div class="programmes-offer-services-sec">
                    <div class="row">
                        @foreach($bulletin as $item)
                            <div class="col-12 col-md-4 bullet-board-card-sec">
                                <div class="bullet-board-card-inner-sec">
                                    <div class="bullet-board-img-sec">
                                        <a href="#">
                                            <img src="{{ asset('uploads/home/' . $item->image) }}" alt="{{ $item->title }}">
                                            <span class="bullet-board-date">{{ \Carbon\Carbon::parse($item->date)->format('d M') }}</span>
                                        </a>
                                    </div>
                                    <div class="bullet-board-content-sec">
                                        <h4>
                                            <a href="#">{{ $item->title }}</a>
                                        </h4>
                                        <p>
                                            <a href="#">
                                                {{ \Illuminate\Support\Str::limit($item->bulletin_description, 150, '...') }}
                                            </a>
                                        </p>
                                        <div class="bullet-board-btn-sec">
                                            <a href="#" class="btn-ecol btn">Read More</a>
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
                                            alt="Client" class="img-fluid">
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


</body>
</html>