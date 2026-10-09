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
            <h1>Alumni Guidance</h1>
            <ul class="bread-list">
              <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
              <li><a href="javascript:void(0)">Alumni Guidance</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    
    
    <section class="alumni-guidance-one-custom-sec">
        <div class="container">
        <div class="row">
          <div class="col-12 col-md-12">
            <h1 class="section-title-one">
              Profile of Members in the
              <span>École Mondiale World School</span>
            </h1>
            <p class="sub-title-one">
              EMWS alumni are in dominating positions across the world in different Careers,
              Companies, and Universities.<br>
              Connect with them to grow Professionally & Personally.
            </p>
          </div>
    
          <!-- Active Alumni (DYNAMIC) -->
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="alumni-guidance-content-one-sec">
              <div class="alumni-guidance-one-img-sec">
                <img src="https://ecolemondiale.org/public/frontend/assets/img/icons/alumni-members-icon.png" alt="Alumni">
              </div>
              <div class="alumni-guidance-content-sub-one-sec">
                <h4>{{ $alumniCount }}</h4>
                <p>Active Alumni Members</p>
              </div>
            </div>
          </div>
    
          <!-- Static (API does NOT provide these) -->
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="alumni-guidance-content-one-sec">
              <div class="alumni-guidance-one-img-sec">
                <img src="https://ecolemondiale.org/public/frontend/assets/img/icons/different-career-chosen-icon.png">
              </div>
              <div class="alumni-guidance-content-sub-one-sec">
                <h4>16</h4>
                <p>Different Career Chosen</p>
              </div>
            </div>
          </div>
    
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="alumni-guidance-content-one-sec">
              <div class="alumni-guidance-one-img-sec">
                <img src="https://ecolemondiale.org/public/frontend/assets/img/icons/companies-represented-icon.png">
              </div>
              <div class="alumni-guidance-content-sub-one-sec">
                <h4>40</h4>
                <p>Companies Represented</p>
              </div>
            </div>
          </div>
    
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="alumni-guidance-content-one-sec">
              <div class="alumni-guidance-one-img-sec">
                <img src="https://ecolemondiale.org/public/frontend/assets/img/icons/countries-represented-icon.png">
              </div>
              <div class="alumni-guidance-content-sub-one-sec">
                <h4>10</h4>
                <p>Countries Represented</p>
              </div>
            </div>
          </div>
    
        </div>
      </div>
    </section>

    
    
    <section class="alumni-section">
        <div class="container">
    
        <div class="section-title-two">
          <h2>École Mondiale World School Guiding Alumni</h2>
          <p>
            We are proud of our alumni who are setting an example and motivating younger students.
            Here are some alumni who are actively guiding current students by answering questions,
            conducting webinars, and much more.
          </p>
        </div>
    
        <div class="alumni-slider-sec">
          <div class="owl-carousel owl-theme alumni-carousal-slide">
    
            @forelse ($alumniList as $alumni)
              <div class="item">
                <div class="alumni-card">
    
                  <div class="alumni-card-upper-sec">
                    <img
                      src="{{ $alumni['image_path'] ?? asset('frontend/assets/img/alumni/default.jpg') }}"
                      alt="{{ $alumni['full_name'] ?? 'Alumni' }}">
    
                    <h5>{{ $alumni['full_name'] ?? '' }}</h5>
                  </div>
    
                  <hr>
    
                  <div class="alumni-card-lower-sec">
                    <ul>
                      <li>
                        <i class="college"></i>
                        <span>
                          {{ $alumni['campus_name'] ?? 'École Mondiale World School' }},
                          Batch {{ $alumni['pass_out_year'] ?? '' }}
                        </span>
                      </li>
    
                      @if (!empty($alumni['department']))
                        <li>
                          <i class="tool"></i>
                          <span>{{ $alumni['department'] }}</span>
                        </li>
                      @endif
    
                      @if (!empty($alumni['institue_name']))
                        <li>
                          <i class="cap"></i>
                          <span>{{ $alumni['institue_name'] }}</span>
                        </li>
                      @endif
                    </ul>
                  </div>
    
                </div>
              </div>
            @empty
              <p class="text-center text-white">No alumni data available.</p>
            @endforelse
    
          </div>
        </div>
    
        <div class="alumni-uni-sec">
          <div class="powerBy justify-content-center">
            <span class="text-white">Powered by</span>
            <a href="https://univariety.com/" target="_blank">
              <img src="{{ asset('frontend/assets/img/icons/univariety-white-logo.svg') }}">
            </a>
          </div>
        </div>
    
      </div>
    </section>





    <section class="alumni-guidance-one-custom-sec">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-12">
            <h1 class="section-title-one">
              Adding Value To
              <span>Our Alumni</span>
            </h1>
            <p class="sub-title-one">We believe in nurturing our students even after they graduate from school. Here’s
              how we do it!</p>
          </div>
        </div>
        <div class="alumni-guidance-tabs-sec">
          <ul class="nav nav-tabs" id="service-details-tabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link first-link active" id="service-details-tab-1-tab" data-bs-toggle="tab"
                data-bs-target="#service-details-tab-1" type="button" role="tab" aria-selected="true">
                Networking
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link second-link" id="service-details-tab-2-tab" data-bs-toggle="tab"
                data-bs-target="#service-details-tab-2" type="button" role="tab" aria-selected="false">
                Learning & Development
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link third-link" id="service-details-tab-3-tab" data-bs-toggle="tab"
                data-bs-target="#service-details-tab-3" type="button" role="tab" aria-selected="false">
                Recognition
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link fourth-link" id="service-details-tab-4-tab" data-bs-toggle="tab"
                data-bs-target="#service-details-tab-4" type="button" role="tab" aria-selected="false">
                Nostalgia
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link fifth-link" id="service-details-tab-5-tab" data-bs-toggle="tab"
                data-bs-target="#service-details-tab-5" type="button" role="tab" aria-selected="false">
                Benefits
              </button>
            </li>
          </ul>
          <div class="tab-content" id="service-details-tabs-content">
            <div class="tab-pane fade show active" id="service-details-tab-1" role="tabpanel">
              <div class="row align-items-center">
                <div class="col-lg-6">
                  <img src="https://ecolemondiale.org/public/frontend/assets/img/home/tab-1.webp" alt="Networking"
                    class="img-fluid rounded-4 our-process-weok-img-sec" loading="lazy">
                </div>
                <div class="col-lg-6">
                  <h3>Networking</h3>
                  <ul>
                    <li>Join quarterly networking sessions online/offline organized by the school</li>
                    <li>Reconnect with your batchmates, seniors, juniors</li>
                    <li>Build meaningful connections - personal & business</li>
                  </ul>
                  <div class="alumni-guidance-tab-button-section">
                    <a class="btn-signUp-alumni-guidance" href="https://ags.univariety.com/user/emws/signup">Sign Up</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="service-details-tab-2" role="tabpanel">
              <div class="row align-items-center">
                <div class="col-lg-6">
                  <img src="https://ecolemondiale.org/public/frontend/assets/img/home/tab-2.webp" alt="Networking"
                    class="img-fluid rounded-4 our-process-weok-img-sec" loading="lazy">
                </div>
                <div class="col-lg-6">
                  <h3>Learning & Development</h3>
                  <ul>
                    <li>Get invited to learning webinars & workshops at no cost</li>
                    <li>Opportunity to upskill in various areas</li>
                    <li>Meet faculty/founders of top universities/organizations</li>
                  </ul>
                  <div class="alumni-guidance-tab-button-section">
                    <a class="btn-signUp-alumni-guidance" href="https://ags.univariety.com/user/emws/signup">Sign Up</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="service-details-tab-3" role="tabpanel">
              <div class="row align-items-center">
                <div class="col-lg-6">
                  <img src="https://ecolemondiale.org/public/frontend/assets/img/home/tab-3.webp" alt="Networking"
                    class="img-fluid rounded-4 our-process-weok-img-sec" loading="lazy">
                </div>
                <div class="col-lg-6">
                  <h3>Recognition</h3>
                  <ul>
                    <li>Get featured on the school’s social media & website for your achievements</li>
                    <li>Nomination for illustrious alumni awards</li>
                    <li>Receive a certificate of recognition for guiding juniors</li>
                  </ul>
                  <div class="alumni-guidance-tab-button-section">
                    <a class="btn-signUp-alumni-guidance" href="https://ags.univariety.com/user/emws/signup">Sign Up</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="service-details-tab-4" role="tabpanel">
              <div class="row align-items-center">
                <div class="col-lg-6">
                  <img src="https://ecolemondiale.org/public/frontend/assets/img/home/tab-4.webp" alt="Networking"
                    class="img-fluid rounded-4 our-process-weok-img-sec" loading="lazy">
                </div>
                <div class="col-lg-6">
                  <h3>Nostalgia</h3>
                  <ul>
                    <li>Receive updates about your school’s achievements</li>
                    <li>Throwback memories of students, teachers, events, etc.</li>
                    <li>Updates about your batchmates</li>
                  </ul>
                  <div class="alumni-guidance-tab-button-section">
                    <a class="btn-signUp-alumni-guidance" href="https://ags.univariety.com/user/emws/signup">Sign Up</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="service-details-tab-5" role="tabpanel">
              <div class="row align-items-center">
                <div class="col-lg-6">
                  <img src="https://ecolemondiale.org/public/frontend/assets/img/home/tab-5.webp" alt="Networking"
                    class="img-fluid rounded-4 our-process-weok-img-sec" loading="lazy">
                </div>
                <div class="col-lg-6">
                  <h3>Benefits</h3>
                  <ul>
                    <li>Access to alumni directory for networking</li>
                    <li>Discounts on certifications & other learning opportunities</li>
                    <li>Access to job & internship opportunities</li>
                  </ul>
                  <div class="alumni-guidance-tab-button-section">
                    <a class="btn-signUp-alumni-guidance" href="https://ags.univariety.com/user/emws/signup">Sign Up</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



    <section class="giving-back-school-sec">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-12">
            <h1 class="section-title-one">
              Giving back to
              <span>school</span>
            </h1>
            <p class="sub-title-one">Your relationship with École Mondiale World School doesn't end once you
              graduate.<br>
              You can stay involved by giving back in a variety of ways.</p>
          </div>
        </div>

        <div class="giving-back-school-custom-one-sec">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <img src="https://ecolemondiale.org/public/frontend/assets/img/home/mentor.webp" alt="Networking" class="img-fluid gbsc-img-sec" loading="lazy">
            </div>
            <div class="col-lg-6">
              <h3>Be A Mentor</h3>
              <p>We believe mentoring is a great opportunity for Alumni to develop new skills and have a chance to share
                the benefit of their experience with young Alumnus. As a Alumni mentor, you can help current Alumnus
                find out more about the reality of courses, college admissions, certain jobs, sectors and professions
                based on your personal experiences.</p>
              <div class="alumni-guidance-tab-button-section">
                <a class="btn-signUp-alumni-guidance" href="https://ags.univariety.com/user/emws/signup">I am Interested</a>
              </div>
            </div>
          </div>
        </div>

        <div class="giving-back-school-custom-two-sec">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <h3>Give A Career Talk</h3>
              <p>Share your career experience with young Alumnus and inspire them to achieve their goals and reach their
                full potential. We believe Alumnus would benefit tremendously from hearing from alumni who have ‘been
                there and done that’ and are able to give invaluable advice by sharing their experiences working in a
                particular role or sector.</p>
              <div class="alumni-guidance-tab-button-section">
                <a class="btn-signUp-alumni-guidance" href="https://ags.univariety.com/user/emws/signup">I am Interested</a>
              </div>
            </div>
            <div class="col-lg-6">
              <img src="https://ecolemondiale.org/public/frontend/assets/img/home/careers-talk-img.webp" alt="Networking" class="img-fluid gbsc-img-sec" loading="lazy">
            </div>
          </div>
        </div>

      </div>
    </section>


  </main>
    
    
       @include('components.frontend.footer')

    @include('components.frontend.main-js')
</body>
</html>