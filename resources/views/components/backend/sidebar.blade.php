<!-- Page Body Start-->
 <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper" data-layout="stroke-svg">
          <div class="logo-wrapper"><a href="{{ route('admin.dashboard') }}"><img class="img-fluid" src="{{ asset('admin/assets/images/logo/logo-icon-1.webp') }}" alt="" style="max-width: 40% !important; margin-top: -21px !important; margin-left: 37px;"></a>
		  	<a href="{{ route('admin.dashboard') }}">
				<img class="img-fluid" src="{{ asset('admin/assets/images/logo/logo-icon-1.webp1') }}" alt="" style="max-width: 15% !important;">
			</a>  
		  <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
          </div>
          <div class="logo-icon-wrapper"><a href="{{ route('admin.dashboard') }}"><img class="img-fluid" src="{{ asset('admin/assets/images/logo/logo-icon-1.webp') }}" alt="" style="max-width: 3% !important; margin-right: 100% !important;"></a></div>
          <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
              <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn"><a href="{{ route('admin.dashboard') }}"><img class="img-fluid" src="{{ asset('admin/assets/images/logo/logo-icon-1.webp') }}" alt="" style="max-width: 5% !important; margin-right: 100% !important;"></a>
                  <div class="mobile-back text-end"> <span>Back </span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                </li>
             
                <li class="sidebar-list {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"> </i>
                  <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.dashboard') }}">
                    <svg class="stroke-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#fill-home') }}"></use>
                    </svg>
                    <span class="lan-3">Dashboard</span>
                  </a>
                </li>

                
                <li class="sidebar-list {{ request()->routeIs('manage-banner-details.index', 'manage-programme-offered.index', 'manage-home-festivities.index','manage-home-features.index','manage-bulletin-board.index','manage-testimonials.index','manage-clients') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"> </i>
                  <a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#arrowright') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#arrowright') }}"></use>
                    </svg>
                    <span>Home</span>
                  </a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ route('manage-banner-details.index') }}" class="{{ request()->routeIs('manage-banner-details.index') ? 'active' : '' }}">Banner Details</a></li>
                    <li><a href="{{ route('manage-programme-offered.index') }}" class="{{ request()->routeIs('manage-programme-offered.index') ? 'active' : '' }}">Programs Offered</a></li>
                    <li><a href="{{ route('manage-home-festivities.index') }}" class="{{ request()->routeIs('manage-home-festivities.index') ? 'active' : '' }}">Festivities</a></li>
                    <li><a href="{{ route('manage-home-features.index') }}" class="{{ request()->routeIs('manage-home-features.index') ? 'active' : '' }}">Features</a></li>
                    <li><a href="{{ route('manage-bulletin-board.index') }}" class="{{ request()->routeIs('manage-bulletin-board.index') ? 'active' : '' }}">Bulletin Board</a></li>
                    <li><a href="{{ route('manage-testimonials.index') }}" class="{{ request()->routeIs('manage-testimonials.index') ? 'active' : '' }}">Testimonials</a></li>
                    <li><a href="{{ route('manage-clients.index') }}" class="{{ request()->routeIs('manage-clients.index') ? 'active' : '' }}">Clients</a></li>
                  </ul>
                </li>

              
              
                <li class="sidebar-list {{ request()->routeIs('manage-what-sets-us-apart.index', 'manage-vision-mission.index', 'manage-message-from-principal.index','manage-governance.index','manage-faculty-and-staff.index','manage-school-calendar.index','manage-about-testimonials.index','manage-child-safeguarding-policy.index','manage-about-alumni.index','manage-accredation-association.index') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"> </i>
                  <a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-layout') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-layout') }}"></use>
                    </svg>
                    <span>About Us</span>
                  </a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ route('manage-what-sets-us-apart.index') }}" class="{{ request()->routeIs('manage-what-sets-us-apart.index') ? 'active' : '' }}">What sets us apart?</a></li>
                    <li><a href="{{ route('manage-vision-mission.index') }}" class="{{ request()->routeIs('manage-vision-mission.index') ? 'active' : '' }}">Vision & Mission</a></li>
                    <li><a href="{{ route('manage-message-from-principal.index') }}" class="{{ request()->routeIs('manage-message-from-principal.index') ? 'active' : '' }}">Message From Principal</a></li>
                    <li><a href="{{ route('manage-governance.index') }}" class="{{ request()->routeIs('manage-governance.index') ? 'active' : '' }}">Governance</a></li>
                    <li><a href="{{ route('manage-faculty-and-staff.index') }}" class="{{ request()->routeIs('manage-faculty-and-staff.index') ? 'active' : '' }}">Faculty & Staff</a></li>
                    <li><a href="{{ route('manage-school-calendar.index') }}" class="{{ request()->routeIs('manage-school-calendar.index') ? 'active' : '' }}">School Calendar</a></li>
                    <li><a href="{{ route('manage-accredation-association.index') }}" class="{{ request()->routeIs('manage-accredation-association.index') ? 'active' : '' }}">Accreditation and Associations</a></li>
                    <li><a href="{{ route('manage-about-testimonials.index') }}" class="{{ request()->routeIs('manage-about-testimonials.index') ? 'active' : '' }}">Testimonials</a></li>
                    <li><a href="{{ route('manage-child-safeguarding-policy.index') }}" class="{{ request()->routeIs('manage-child-safeguarding-policy.index') ? 'active' : '' }}">Child Safeguarding Policy</a></li>
                    <li><a href="{{ route('manage-about-alumni.index') }}" class="{{ request()->routeIs('manage-about-alumni.index') ? 'active' : '' }}">Alumni</a></li>
                  </ul>
                </li>


                <li class="sidebar-list {{ request()->routeIs('manage-admission-criteria.index', 'manage-faqs.index', 'manage-merit-scholarships.index','manage-fee-structure.index','manage-apply-admission.index','manage-schedule-visit.index','manage-enquiry-admission.index') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"> </i>
                  <a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-calendar') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-calendar') }}"></use>
                    </svg>
                    <span>Admissions</span>
                  </a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ route('manage-apply-admission.index') }}" class="{{ request()->routeIs('manage-apply-admission.index') ? 'active' : '' }}">Apply For Admission</a></li>
                    <li><a href="{{ route('manage-schedule-visit.index') }}" class="{{ request()->routeIs('manage-schedule-visit.index') ? 'active' : '' }}">Schedule A Visit</a></li>
                    <li><a href="{{ route('manage-enquiry-admission.index') }}" class="{{ request()->routeIs('manage-enquiry-admission.index') ? 'active' : '' }}">Enquiry About Admission</a></li>
                    <li><a href="{{ route('manage-admission-criteria.index') }}" class="{{ request()->routeIs('manage-admission-criteria.index') ? 'active' : '' }}">Admission Criteria</a></li>
                    <li><a href="{{ route('manage-faqs.index') }}" class="{{ request()->routeIs('manage-faqs.index') ? 'active' : '' }}">FAQs</a></li>
                    <li><a href="{{ route('manage-fee-structure.index') }}" class="{{ request()->routeIs('manage-fee-structure.index') ? 'active' : '' }}">Fee Structure</a></li>
                    <li><a href="{{ route('manage-merit-scholarships.index') }}" class="{{ request()->routeIs('manage-merit-scholarships.index') ? 'active' : '' }}">Merit Scholarship</a></li>
    
                  </ul>
                </li>


                <li class="sidebar-list {{ request()->routeIs('manage-policies.index', 'manage-faqs.index', 'manage-merit-scholarships.index','manage-fee-structure.index','manage-apply-admission.index','manage-schedule-visit.index','manage-enquiry-admission.index') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"> </i>
                  <a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-widget') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-widget') }}"></use>
                    </svg>
                    <span>Academics</span>
                  </a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ route('manage-policies.index') }}" class="{{ request()->routeIs('manage-policies.index') ? 'active' : '' }}">Policies</a></li>
                  </ul>
                </li>



                <li class="sidebar-list {{ request()->routeIs('manage-virtual-tour.index', 'manage-media-center.index', 'manage-ib-visual.index','manage-technology.index','manage-sports-activities.index','manage-service-learning.index','manage-safety-security.index','manage-bus-service.index','manage-other-facilities.index','manage-stuco.index','manage-cafeteria.index','manage-gallery-images.index','manage-gallery-videos.index') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"> </i>
                  <a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-to-do') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-to-do') }}"></use>
                    </svg>
                    <span>Campus Life</span>
                  </a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ route('manage-virtual-tour.index') }}" class="{{ request()->routeIs('manage-virtual-tour.index') ? 'active' : '' }}">Virtual Tour</a></li>
                    <li><a href="{{ route('manage-media-center.index') }}" class="{{ request()->routeIs('manage-media-center.index') ? 'active' : '' }}">Media Centre</a></li>
                    <li><a href="{{ route('manage-ib-visual.index') }}" class="{{ request()->routeIs('manage-ib-visual.index') ? 'active' : '' }}">IB Visual</a></li>
                    <li><a href="{{ route('manage-technology.index') }}" class="{{ request()->routeIs('manage-technology.index') ? 'active' : '' }}">Technology</a></li>
                    <li><a href="{{ route('manage-sports-activities.index') }}" class="{{ request()->routeIs('manage-sports-activities.index') ? 'active' : '' }}">Sports Activities</a></li>
                  
                    <li class="{{ request()->routeIs('manage-gallery-images.index', 'manage-gallery-videos.index') ? 'active' : '' }}"><a class="submenu-title" href="#">Gallery<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                      <ul class="nav-sub-childmenu submenu-content">
                        <li><a href="{{ route('manage-gallery-images.index') }}">Images</a></li>
                        <li><a href="{{ route('manage-gallery-videos.index') }}">Videos</a></li>
                      </ul>
                    </li>

                    <li><a href="{{ route('manage-stuco.index') }}" class="{{ request()->routeIs('manage-stuco.index') ? 'active' : '' }}">STUCO</a></li>
                    <li><a href="{{ route('manage-service-learning.index') }}" class="{{ request()->routeIs('manage-service-learning.index') ? 'active' : '' }}">Service Learning</a></li>
                    <li><a href="{{ route('manage-cafeteria.index') }}" class="{{ request()->routeIs('manage-cafeteria.index') ? 'active' : '' }}">Cafeteria</a></li>
                    <li><a href="{{ route('manage-safety-security.index') }}" class="{{ request()->routeIs('manage-safety-security.index') ? 'active' : '' }}">Safety and Security</a></li>
                    <li><a href="{{ route('manage-bus-service.index') }}" class="{{ request()->routeIs('manage-bus-service.index') ? 'active' : '' }}">Bus Service</a></li>
                    <li><a href="{{ route('manage-other-facilities.index') }}" class="{{ request()->routeIs('manage-other-facilities.index') ? 'active' : '' }}">Other Facilities</a></li>
                  
                  </ul>
                </li>


                <li class="sidebar-list {{ request()->routeIs('manage-university-bath.index', 'manage-career.index') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"> </i>
                  <a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#notification-header') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#notification-header') }}"></use>
                    </svg>
                    <span>Careers</span>
                  </a>
                  <ul class="sidebar-submenu">
                  <li>
                      <a class="submenu-title {{ request()->routeIs('manage-teaching-jobs.*') ? 'active' : '' }}" href="#">
                          Career Opportunities
                          <span class="sub-arrow"><i class="fa fa-angle-right"></i></span>
                      </a>

                      <ul class="nav-sub-childmenu submenu-content">
                          <li><a href="{{ route('manage-teaching-jobs.index') }}">Teaching Job</a></li>
                          <li><a href="{{ route('manage-career.create') }}">Non Teaching Job</a></li>
                      </ul>
                  </li>
                    <li><a href="{{ route('manage-university-bath.index') }}" class="{{ request()->routeIs('manage-university-bath.index') ? 'active' : '' }}">University of Bath</a></li> 
                  </ul>
                </li>


                <li class="sidebar-list {{ request()->routeIs('manage-contact-us.index') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"></i>
                  <a class="sidebar-link" href="{{ route('manage-contact-us.index') }}">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-contact') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-contact') }}"></use>
                    </svg>
                    <span>Contact Us</span>
                  </a>
                </li>


                 <li class="sidebar-list {{ request()->routeIs('manage-privacy-policy.index') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"></i>
                  <a class="sidebar-link" href="{{ route('manage-privacy-policy.index') }}">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-bookmark') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-bookmark') }}"></use>
                    </svg>
                    <span>Privacy Policy</span>
                  </a>
                </li>

                
              </ul>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </div>


        