    @php
        $contact_us = \App\Models\ContactUs::whereNull('deleted_by')->first();
        $announcements = $contact_us && $contact_us->announcements ? json_decode($contact_us->announcements, true) : [];
    @endphp
   
   <div class="top_announcement">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  @if(!empty($contact_us->announcements))
                      @php
                          $announcements = json_decode($contact_us->announcements, true);
                      @endphp
                      <marquee scrollamount="8" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                          @foreach($announcements as $announcement)
                              {{ $announcement['title'] }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                          @endforeach
                      </marquee>
                  @else
                      <marquee scrollamount="8" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                          No announcements available
                      </marquee>
                  @endif
              </div>
          </div>
      </div>
  </div>

 
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ route('frontend.index') }}" class="logo d-flex align-items-center me-auto">
        <img src="{{ asset('frontend/assets/img/emws-logo.png') }}" alt="">
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li class="dropdown"><a href="#"><span>About Us</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="{{ route('frontend.what_sets_us_apart') }}">What sets us apart?</a></li>
              <li><a href="{{ route('frontend.vision_mission_and_values') }}">Vision, Mission & Values</a></li>
              <li><a href="{{ route('frontend.message_from_the_principal') }}">Message From The Principal</a></li>
              <li><a href="{{ route('frontend.governance') }}">Governance</a></li>
              <li><a href="https://www.rsicollege.org/" target="_blank">Russell Square International College</a></li>
              <li><a href="{{ route('frontend.faculty_and_staff') }}">Faculty & Staff</a></li>
              <li><a href="{{ route('frontend.school_calendar') }}">School Calendar</a></li>
              <li><a href="{{ route('frontend.accreditation_and_associations') }}">Accreditation & Associations</a></li>
              <li><a href="{{ route('frontend.testimonials') }}">Testimonials</a></li>
              <li><a href="{{ route('frontend.child_safeguarding_policy') }}">Child Protection Policy</a></li>
              <li><a href="{{ route('frontend.alumni') }}">Alumni</a></li>
            </ul>
          </li>

          <li class="dropdown"><a href="#"><span>Admissions</span> <i
                class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Apply for admission</a></li>
              <li><a href="#">Schedule a Visit</a></li>
              <li><a href="#">Enquire about admission</a></li>
              <li><a href="{{ route('frontend.admission_criteria_and_process') }}">Admission Criteria & Process</a></li>
              <li><a href="{{ route('frontend.faq') }}">FAQs</a></li>
              <li><a href="{{ route('frontend.fee_structure') }}">Fee Structure</a></li>
              <li><a href="{{ route('frontend.merit_scholarship') }}">Merit Scholarship</a></li>
            </ul>
          </li>

          <li class="dropdown"><a href="#"><span>Academics</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li class="dropdown"><a href="#"><span>Curriculum Overview</span> <i
                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Primary Years</a></li>
                  <li><a href="#">Middle Years</a></li>
                  <li><a href="#">Diploma</a></li>
                  <li><a href="#">Creativity, Activity, Service</a></li>
                </ul>
              </li>
              <li><a href="#">Policies</a></li>
              <li><a href="#">IB Early Years & Primary Years Programme</a></li>
              <li><a href="#">IB Middle Years Programme</a></li>
              <li><a href="#">IB Diploma Programme</a></li>
              <li><a href="#">Student Support Services</a></li>
              <li><a href="#">University & College Counselling Programme</a></li>
              <li><a href="#">IB Learner Profile</a></li>
            </ul>
          </li>

          <li class="dropdown"><a href="#"><span>Campus Life</span> <i
                class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="{{ route('frontend.virtual_tour') }}">Virtual Tour</a></li>
              <li><a href="{{ route('frontend.media_center') }}">Media Centre</a></li>
              <li><a href="{{ route('frontend.ib_visual_and_performing_arts') }}">IB Visual & Performing Arts</a></li>
              <li><a href="{{ route('frontend.technology') }}">Technology</a></li>
              <li><a href="{{ route('frontend.sports_and_extra_curricular_activities') }}">Sports and Extra Curricular Activities</a></li>
              <li><a href="{{ route('frontend.gallery') }}">Gallery</a></li>
              <li><a href="{{ route('frontend.stuco') }}">STUCO</a></li>
              <li><a href="{{ route('frontend.service_learning') }}">Service Learning</a></li>
              <li><a href="{{ route('frontend.cafeteria') }}">Cafeteria</a></li>
              <li><a href="{{ route('frontend.safety_and_security') }}">Safety and Security</a></li>
              <li><a href="#">Bus Service</a></li>
              <li><a href="#">Other Facilities</a></li>
            </ul>
          </li>

          <li class="dropdown"><a href="#"><span>Bulletin Board</span> <i
                class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Announcements</a></li>
              <li><a href="#">News</a></li>
              <li><a href="#">Events</a></li>
              <li><a href="#">Blogs</a></li>
            </ul>
          </li>

          <li class="dropdown"><a href="#"><span>Careers</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Career Opportunities</a></li>
              <li><a href="#">University of Bath</a></li>
            </ul>
          </li>

        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="cus-menu-contact-us-btn" href="{{ route('frontend.contact_us') }}">Contact Us</a>
      <a class="cus-menu-talk-to-us-btn"
        href="https://api.whatsapp.com/send/?phone=9326020914&text=Hello%20%C3%89cole%20Admissions%20Team%2C%0A%0AI%E2%80%99m%20interested%20in%20admissions%202026-27.&utm_source=website&utm_medium=cta&utm"
        target="_blank">Talk To Us
      </a>
    </div>
  </header>