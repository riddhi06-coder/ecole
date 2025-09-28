   <div class="top_announcement">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <marquee scrollamount="8" behavior="scroll" direction="left" onmouseover="this.stop();"
            onmouseout="this.start();">
            Admissions open for the academic year 2025-2026
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
            IB Continuum School
          </marquee>
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
              <li><a href="#">Admission Criteria & Process</a></li>
              <li><a href="#">FAQs</a></li>
              <li><a href="#">Fee Structure</a></li>
              <li><a href="#">Merit Scholarship</a></li>
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
              <li><a href="#">Virtual Tour</a></li>
              <li><a href="#">Media Centre</a></li>
              <li><a href="#">IB Visual & Performing Arts</a></li>
              <li><a href="#">Technology</a></li>
              <li><a href="#">Sports and Extra Curricular Activities</a></li>
              <li><a href="#">Gallery</a></li>
              <li><a href="#">STUCO</a></li>
              <li><a href="#">Service Learning</a></li>
              <li><a href="#">Cafeteria</a></li>
              <li><a href="#">Safety and Security</a></li>
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
      <a class="cus-menu-talk-to-us-btn" href="#">Talk To Us</a>
    </div>
  </header>