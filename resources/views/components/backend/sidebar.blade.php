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

                
                <li class="sidebar-list {{ request()->routeIs('manage-banner-details.index', 'manage-programme-offered.index', 'manage-home-festivities.index','manage-home-features.index','manage-bulletin-board') ? 'active' : '' }}">
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
                  </ul>
                </li>

                

              </ul>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </div>


        