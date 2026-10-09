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
    <section class="ecolemon-breadcrumb-sec" style="background-image: url('https://www.ecolemondiale.org/uploads/academics/1762416052171.webp'); background-size: cover; background-position: center;">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h1>Creating Student Successes, Always!</h1>
            <ul class="bread-list">
              <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
              <li><a href="javascript:void(0)">Success Stories</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section class="success-stories-one-custom-sec">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-12">
            <h1 class="section-title-one">
              Student Insights
            </h1>
            <p class="sub-title-one">École Mondiale World School students are in dominating positions across the
              world<br>
              in different Careers, Companies and Universities.</p>
          </div>
          <div class="col-md-4">
            <div class="alumni-guidance-content-one-sec">
              <div class="alumni-guidance-one-img-sec">
                <img src="https://ecolemondiale.org/public/frontend/assets/img/icons/university.png" alt="Phone">
              </div>
              <div class="alumni-guidance-content-sub-one-sec">
                <h4>252</h4>
                <p>Universities Have Made Offers</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="alumni-guidance-content-one-sec">
              <div class="alumni-guidance-one-img-sec">
                <img src="https://ecolemondiale.org/public/frontend/assets/img/icons/college.png" alt="Phone">
              </div>
              <div class="alumni-guidance-content-sub-one-sec">
                <h4>114</h4>
                <p>Admissions In Prestigious Colleges</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <section class="alumni-section">
      <div class="container">
    
        <div class="section-title-two">
          <h2>Success Stories</h2>
          <p>
            Here are some notable alumni who are out there making their
            dreams come true and making us proud too!
          </p>
        </div>
    
        <div class="alumni-slider-sec">
          <div class="owl-carousel owl-theme success-stories-carousal-slide">
    
            @foreach($alumniList as $alumni)
              <div class="alumni-card">
    
                <div class="alumni-card-upper-sec">
                  <img
                    src="{{ $alumni['image'] ?? asset('frontend/assets/img/alumni/default.jpg') }}"
                    alt="{{ $alumni['name'] ?? 'Alumni' }}">
    
                  <h5>{{ $alumni['name'] ?? '' }}</h5>
    
                  <small>
                    {{ $alumni['school_name'] ?? 'École Mondiale World School' }},
                    Batch {{ $alumni['batch_year'] ?? '' }}
                  </small>
                </div>
    
                <hr>
    
                <div class="alumni-card-lower-sec">
                  <ul>
                    <li>
                      <i class="college"></i>
                      <span>
                        {{ $alumni['previous_school'] ?? 'École Mondiale World School, Mumbai' }},
                        Batch {{ $alumni['previous_batch'] ?? '' }}
                      </span>
                    </li>
    
                    <li>
                      <i class="tool"></i>
                      <span>{{ $alumni['career'] ?? '' }}</span>
                    </li>
    
                    <li>
                      <i class="cap"></i>
                      <span>{{ $alumni['college'] ?? '' }}</span>
                    </li>
                  </ul>
                </div>
    
              </div>
            @endforeach
    
          </div>
        </div>
    
      </div>
    </section>

    
    
    <section class="success-stories-three-custom-sec">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="section-title-one">
              Global Citizens & Diverse Career Paths
            </h1>
            <p class="sub-title-one">
              École Mondiale World School students are making a mark in different career fields
              across the globe.<br>
              We are proud to see how successful they are today!
            </p>
          </div>
        </div>
    
        <div class="top-careers">
          <h2>Top Careers</h2>
    
          @if(!empty($topCareers))
            @foreach($topCareers as $career)
              <div class="career-item">
                <div class="career-label">
                  {!! nl2br(e($career['carrer'])) !!}
                </div>
    
                <div class="career-bar">
                  <span style="width: {{ $career['percentage'] }}%"></span>
                </div>
    
                <div class="career-percent">
                  {{ $career['percentage'] }}%
                </div>
              </div>
            @endforeach
          @else
            <p>No career data available at the moment.</p>
          @endif
    
        </div>
      </div>
    </section>


    <section class="top-colleages-bg-custom-sec">
      <div class="container">
    
        <div class="row">
          <div class="col-12">
            <h1 class="section-title-one">Top Colleges</h1>
            <p class="sub-title-one">
              We prepare our students for success.<br>
              Pick a top college and you’ll find a School student studying there.
            </p>
          </div>
        </div>
    
        <div class="success-stories">
          <div class="row">
    
            <!-- LEFT TABS -->
            <div class="col-lg-4">
              <div class="list-group country-tabs" role="tablist">
                @foreach($topColleges as $index => $country)
                  <button
                    class="list-group-item {{ $index === 0 ? 'active' : '' }}"
                    data-bs-toggle="tab"
                    data-bs-target="#country-{{ $index }}"
                    type="button">
                    {{ $country['name'] }}
                    <span>({{ $country['count'] }})</span>
                  </button>
                @endforeach
              </div>
            </div>
    
            <!-- RIGHT CONTENT -->
            <div class="col-lg-8">
              <div class="tab-content university-wrapper">
    
                @foreach($topColleges as $index => $country)
                  <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                       id="country-{{ $index }}">
    
                    <div class="row g-4">
                      @foreach($country['data'] as $college)
                        <div class="col-md-6 university-item">
                          <img
                            src="{{ $college['logo'] ?? asset('frontend/assets/img/logo/boston-university-img.jpg') }}"
                            alt="{{ $college['name'] }}">
                          <span>{{ $college['name'] }}</span>
                        </div>
                      @endforeach
                    </div>
    
                  </div>
                @endforeach
    
              </div>
            </div>
    
          </div>
        </div>
    
      </div>
    </section>

    
    

    <section class="giving-back-school-sec your-child-gets-these-benefits-section">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-12">
            <h1 class="section-title-one">
              Your Child Gets These Benefits
            </h1>
            <p class="sub-title-one">A single platform for students to connect with their<br>
              Alumni of different batches and branches from around the world.</p>
          </div>
        </div>

        <div class="giving-back-school-custom-one-sec">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <img src="https://ecolemondiale.org/public/frontend/assets/img/home/alumni-img-one.webp" alt="Networking" class="img-fluid gbsc-img-sec" loading="lazy">
            </div>
            <div class="col-lg-6">
              <h6><img src="https://ecolemondiale.org/public/frontend/assets/img/icons/view-icon.png" alt="">View</h6>
              <h3>View Alumni Journey</h3>
              <p>Right from entrance exams taken to colleges applied and admitted to, students can view their alumni
                journeys. The unique platform enables students to filter by interest and view thousands of alumni
                profiles.</p>
            </div>
          </div>
        </div>

        <div class="giving-back-school-custom-two-sec">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <h6><img src="https://ecolemondiale.org/public/frontend/assets/img/icons/watch-icon.png" alt="">Watch</h6>
              <h3>Watch Real-time Video Case Studies</h3>
              <p>Students get access to a large video library with alumni videos on various topics, real-time case
                studies related to college admissions, application process and more. The video library also has
                pre-recorded webinars conducted by alumni.</p>
            </div>
            <div class="col-lg-6">
              <img src="https://ecolemondiale.org/public/frontend/assets/img/home/careers-talk-img.webp" alt="Networking" class="img-fluid gbsc-img-sec"
                loading="lazy">
            </div>
          </div>
        </div>

        <div class="giving-back-school-custom-one-sec">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <img src="https://ecolemondiale.org/public/frontend/assets/img/home/ask-img.webp" alt="Networking" class="img-fluid gbsc-img-sec" loading="lazy">
            </div>
            <div class="col-lg-6">
              <h6><img src="https://ecolemondiale.org/public/frontend/assets/img/icons/ask-icon.png" alt="">Ask</h6>
              <h3>Ask 1-1 Questions to Alumni</h3>
              <p>There's no better way to seek guidance from someone who's been there and done that. Students can reach
                out to their seniors from across batches and campuses to ask anything and everything about career
                clarity.</p>
            </div>
          </div>
        </div>

      </div>
    </section>



    <section class="alumni-section alumni-mentor-custom-section">
      <div class="container">
        <div class="section-title-two">
          <h2>Alumni Mentors</h2>
          <p>Our students get first-hand guidance from those who’ve been there and done that!</p>
        </div>
    
        <div class="alumni-slider-sec">
          <div class="owl-carousel owl-theme alumni-mentor-carousal-slide">
    
            @foreach($alumniList as $alumni)
              <div class="alumni-card">
                <div class="alumni-card-upper-sec">
                  <img src="{{ $alumni['image'] }}" alt="{{ $alumni['name'] }}">
                  <h5>{{ $alumni['name'] }}</h5>
                  <small>{{ $alumni['school_name'] }}, Batch {{ $alumni['batch_year'] }}</small>
                </div>
                <hr>
                <div class="alumni-card-lower-sec">
                  <ul>
                    <li><i class="college"></i> <span>{{ $alumni['previous_school'] }}, Batch {{ $alumni['previous_batch'] }}</span></li>
                    <li><i class="tool"></i> <span>{{ $alumni['career'] }}</span></li>
                    <li><i class="cap"></i> <span>{{ $alumni['college'] }}</span></li>
                  </ul>
                </div>
              </div>
            @endforeach
    
          </div>
        </div>
      </div>
    </section>


  </main>
    
    
    @include('components.frontend.footer')

    @include('components.frontend.main-js')
    
    <script>
        $(".success-stories-carousal-slide").owlCarousel({
          loop: true,
          margin: 20,
          nav: true,
          dots: false,
          autoplay: true,
          autoplayTimeout: 4000,
          smartSpeed: 800,
          responsive: {
            0: { items: 1 },
            576: { items: 1 },
            992: { items: 3 },
            1200: { items: 4 }
          },
          navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
        });
    </script>
    <script>
        $(".alumni-mentor-carousal-slide").owlCarousel({
      loop: true,
      margin: 20,
      nav: true,
      dots: false,
      autoplay: true,
      autoplayTimeout: 4000,
      smartSpeed: 800,
      responsive: {
        0: { items: 1 },
        576: { items: 1 },
        992: { items: 3 },
        1200: { items: 4 }
      },
      navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
    });
    </script>
</body>
</html>