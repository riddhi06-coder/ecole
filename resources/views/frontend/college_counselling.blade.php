<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">


        <section class="ecolemon-breadcrumb-sec ecol-academics-breadcrumb-sec" style="background-image: url('{{ asset('uploads/academics/'.$college_counselling_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <h1>{{  $college_counselling_banner->banner_heading ? $college_counselling_banner->banner_heading : 'What sets us apart?' }}</h1>
                        <ul class="bread-list">
                            <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
                            <li><a href="javascript:void(0)">Academics<i class="fa fa-angle-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">{{  $college_counselling_banner->banner_heading ? $college_counselling_banner->banner_heading : 'What sets us apart?' }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="college-counselling-sec">
            <div class="container">
                <div class="college-counselling-inner-one-sec">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="college-counselling-img-sec">
                                <img src="{{ asset('uploads/academics/' . $college_counselling_banner->section_image) }}" class="img-fluid"
                                    alt="College Counselling Image">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="college-counselling-content-sec">
                                <h4 class="college-counselling-title">{{  $college_counselling_banner->section_heading ? $college_counselling_banner->section_heading : 'What sets us apart?' }}</h4>
                                <p>{!! $college_counselling_banner->section_description  !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="colcouns-drop-filter-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 acedemic-desc">
                        <p>{!! $college_counselling_banner->description  !!}</p>
                    </div>

                    <div class="country-filter-sec">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4">
                                <label for="country" class="form-label country-filter-title">
                                    Choose Your Country
                                </label>
                                <select id="country" class="form-select" name="country">
                                    <option value="">-- Select Country --</option>
                                    <option value="13">Australia</option>
                                    <option value="38">Canada</option>
                                    <option value="73">France</option>
                                    <option value="96">Hong Kong</option>
                                    <option value="99" selected>India</option>
                                    <option value="107">Japan</option>
                                    <option value="150">Netherlands</option>
                                    <option value="153">New Zealand</option>
                                    <option value="160">Norway</option>
                                    <option value="192">Singapore</option>
                                    <option value="197">South Africa</option>
                                    <option value="199">Spain</option>
                                    <option value="206">Switzerland</option>
                                    <option value="224">United Arab Emirates</option>
                                    <option value="225">United Kingdom</option>
                                    <option value="226">United States</option>
                                </select>
                            </div>

                            <!-- Schools Sidebar -->
                            <div class="col-12 col-md-12 col-lg-12 country-available-wrap-sec">
                                <div id="schools" class="country-ava-school-sec">

                                    <!-- India -->
                                    <div class="country-india-sec">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>DSK International School of Design, Pune</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Ecole Hoteliere Lavasa, Pune</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>EMDI Institute of Media and Communication, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Flame (Foundation for Liberal and Management Education),
                                                            Pune
                                                        </h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>GD Goenka University</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Government Law College, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>H.R. College of Commerce and Economics, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Indian School of Business</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Indian School of Design & Innovation</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Indian School of Management & Entrepreneurship</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>International Institute of Fashion Design (INIFD), Mumbai
                                                        </h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>ISDI - Indian School of Design & Innovation, Parsons, Mumbai
                                                        </h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Jai Hind College, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>K J Somaiya College Of Science And Commerce, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Kamla Raheja Vidyanidhi Institute, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Kishinchand Chellaram College, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>L.S.Raheja College of Arts & Commerce, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Lala Lajpat Rai College of Commerce & Economics, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Lala Lajpat Rai Institute of Management, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Mithibai College, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Mod'Art International, International Institute of Fashion
                                                            Design
                                                            & Fashion Management, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Mumbai Educational Trust (MET), Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Narsee Monjee Institute of Management Studies, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>O. P. Jindal Global University, Delhi</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Padmashree Dr. D. Y. Patil University, Navi Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Pearl Academy Of Fashion</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Rachana Sansad - School of Interior Design</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Raffles Design International, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Raffles University</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Ramnarain Ruia College</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Russell Square International College (University of London),
                                                            Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>S.N.D.T Women's University, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Sathaye College, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Smt. M.M.K College of Commerce & Economics</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Sophia College For Women, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>SP Jain Institute of Management & Research, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>St. Xavier's College, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>SVKM's Institute of International Studies, Kingston
                                                            University
                                                        </h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>SVKM's Usha Pravin Gandhi College of Law, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Symbiosis College of Arts & Commerce</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Symbiosis Law School</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Symbiosis School for Liberal Arts</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Thakur College of Science & Commerce, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>The ICAI (The Institute of Chartered Accountants of India)
                                                        </h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>The Indian Institute of Planning and Management (IIPM)</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>The Mudra Institute of Communications, Ahmedabad</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>The One School Goa</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Usha Pravin Gandhi College of Management, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Whistling Woods International, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Wilson College, Mumbai</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Yash Raj Studio</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Lady Shri Ram College for Women, New Delhi</h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>SVKM's Harkisan Mehta Institute of Media, Research and
                                                            Analysis
                                                        </h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="99">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Welingkar Institute of Management Development & Research
                                                        </h6>
                                                        <small>India</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- India -->
                                    <!-- Australia -->
                                    <div class="country-australia-sec">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="13">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Bond University</h6>
                                                        <small>Australia</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="13">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Griffith University</h6>
                                                        <small>Australia</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="13">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>International College of Management, Sydney</h6>
                                                        <small>Australia</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="13">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Macquarie University</h6>
                                                        <small>Australia</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="13">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>The University of Melbourne</h6>
                                                        <small>Australia</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="13">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of New South Wales</h6>
                                                        <small>Australia</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Australia -->
                                    <!-- Canada -->
                                    <div class="country-canada-sec">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="38">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>McGill University</h6>
                                                        <small>Canada</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="38">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Sauder School of Business - The University of British Columbia</h6>
                                                        <small>Canada</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="38">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>The University of British Columbia</h6>
                                                        <small>Canada</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="38">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Toronto</h6>
                                                        <small>Canada</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="38">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>York University</h6>
                                                        <small>Canada</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Canada -->
                                    <!-- France -->
                                    <div class="country-france-sec">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="73">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Hamilton College, Paris</h6>
                                                        <small>France</small>
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>
                                    <!-- France -->
                                    <!-- Hong Kong -->
                                    <div class="country-hong-kong-sec">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="96">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>City University of Hong Kong</h6>
                                                        <small>Hong Kong</small>
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>
                                    <!-- Hong Kong -->
                                    <!-- Japan -->
                                    <div class="country-japan-sec">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="107">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Waseda University</h6>
                                                        <small>Japan</small>
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>
                                    <!-- Japan -->
                                    <!-- Netherlands -->
                                    <div class="country-netherlands-sec">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="150">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Maastricht University</h6>
                                                        <small>Netherlands</small>
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>
                                    <!-- Netherlands -->
                                    <!-- New Zealand -->
                                    <div class="country-new-zealand-sec">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="153">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>AUT (Auckland University of Technology)</h6>
                                                        <small>New Zealand</small>
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>
                                    <!-- New Zealand -->
                                    <!-- Norway -->
                                    <div class="country-norway-sec">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="160">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>BI Norwegian Business School, Oslo</h6>
                                                        <small>Norway</small>
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>
                                    <!-- Norway -->
                                    <!-- Singapore -->
                                    <div class="country-singapore-sec">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="192">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>James Cook University</h6>
                                                        <small>Singapore</small>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="192">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Lasalle College of the Arts</h6>
                                                        <small>Singapore</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="192">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>les Roches International School of Hotel Management</h6>
                                                        <small>Singapore</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="192">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>National University of Singapore</h6>
                                                        <small>Singapore</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="192">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>PSB Academy</h6>
                                                        <small>Singapore</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="192">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>S P Jain School of Global Management</h6>
                                                        <small>Singapore</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="192">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Singapore Management University</h6>
                                                        <small>Singapore</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="192">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>TMC Academy</h6>
                                                        <small>Singapore</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Singapore -->
                                    <!-- South Africa -->
                                    <div class="country-south-africa-sec">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="197">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Vega, The Brand Communications School</h6>
                                                        <small>South Africa</small>
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>
                                    <!-- South Africa -->
                                    <!-- Spain -->
                                    <div class="country-spain-sec">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="199">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>IE University</h6>
                                                        <small>Spain</small>
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="199">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>EU Business School</h6>
                                                        <small>Spain</small>
                                                    </div>
                                                </div>
                                            </div>                                         
                                        </div>
                                    </div>
                                    <!-- Spain -->
                                    <!-- Switzerland -->
                                    <div class="country-switzerland-sec">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="206">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>les Roches International School of Hotel Management</h6>
                                                        <small>Switzerland</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="206">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Geneva Business School</h6>
                                                        <small>Switzerland</small>
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>
                                    <!-- Switzerland -->
                                     <!-- United Arab Emirates -->
                                    <div class="country-united-arab-emirates-sec">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="224">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>American University in Dubai</h6>
                                                        <small>United Arab Emirates</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="224">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Heriot Watt University</h6>
                                                        <small>United Arab Emirates</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="224">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>The Emirates Academy of Hospitality Management</h6>
                                                        <small>United Arab Emirates</small>
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="224">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Bahrain - College of Arts</h6>
                                                        <small>United Arab Emirates</small>
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>
                                    <!-- United Arab Emirates -->
                                    <!-- United Kingdom -->
                                    <div class="country-united-kingdom-sec">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Art Center College of Design</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Aston University</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Birmingham City University</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Brunel University, London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Cardiff University</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Cass Business School, City, University of London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Central Saint Martins - University of the Arts London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>City and Guilds of London Art School</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>City, University of London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Durham University, UK</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>European Business School, London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Goldsmiths, University of London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Imperial College London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>INTO College</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Istituto Marangoni, London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>King's College London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Kingston University</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Lancaster University</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Lincoln University</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Liverpool John Moores University</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>London Business School</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>London College of Communication</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>London College of Fashion - (University of the Arts London)</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>London Metropolitan University</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>London School of Business & Finance</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>London School of Economics and Political Science</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>London School of Fashion</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>London School of Pharmacy</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Loughborough University</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>MetFilm School London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>New College of the Humanities</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Nottingham Trent University</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Oxford Brookes University</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Queens University Belfast</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Queen Mary University of London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Regent's Business School London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Regent's College</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Regents University, London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Robert Gordon University, Aberdeen Scotland</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Royal Holloway, University of London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Sotheby's Institute of Art, London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>The London School of Economics & Political Science</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>The University of Edinburgh</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>The University of Liverpool</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>The University of Manchester</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>The University of Nottingham</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>The University of Sheffield</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>The University of York</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Glasgow</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University for the Creative Arts</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University College London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of BATH</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of East Anglia, Norwich</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Exeter</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Greenwich</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Roehampton</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of St Andrews</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Sussex</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of the Arts London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Warwick</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Westminster</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of West London</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Wisconsin-Madison</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="225">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of York</h6>
                                                        <small>United Kingdom</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- United Kingdom -->



                                    <!-- United States -->
                                    <div class="country-united-states-sec">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Adelphi University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Arizona State University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Art Center College of Design - Pasadena</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Babson College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Bard College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Barnard College (Colombia University)</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Beloit College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Bentley University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Berklee College of Music</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Binghamton University - State University of New York</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Boston University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Boston University School of Medicine</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Brandeis University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Brown University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Bryant University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Bryn Mawr College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>California College of Arts</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>California Lutheran University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Carnegie Mellon University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>CFA Institute</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Chapman University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Claremont McKenna College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Columbia College Chicago</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Columbia University, New York</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Cornell University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Denison University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Drexel University – Philadelphia</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Eckerd College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Embry–Riddle Aeronautical University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Emerson College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Emory University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Eugene Lang College The New School for Liberal Arts</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Fashion Institute of Design & Merchandising</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Fashion Institute of Technology</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Fisher College of Business</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Florida Institute of Technology</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Fordham University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Franklin & Marshall College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>George Washington University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Georgetown University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Georgia Institute of Technology</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Goucher College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Hamilton College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Harvey Mudd College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Hofstra University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Hult International Business School</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Huntington University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Indiana University Bloomington</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Ithaca College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Johns Hopkins University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Kellogg School of Management</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Loyola Marymount University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Loyola University Maryland</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Marist College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Marymount Manhattan College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Michigan State University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Mount Holyoke College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Muhlenberg College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Musicians Institute</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>New York Film Academy</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>New York University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Northeastern University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Northwestern University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>NYU Stern School of Business</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Ohio State University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Otis College of Arts and Design</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Oxford College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Oxford College, Emory University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Pace University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Parsons The New School for Design</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Pennsylvania State University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Pepperdine University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Pitzer College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Pomona College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Pontifical Catholic University of Argentina</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Pratt MWP</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Purdue University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Reed College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Rensselaer Polytechnic Institute</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Rhode Island School of Design</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Rochester Institute of Technology</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Rollins College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Rose-Hulman Institute of Technology</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Rutgers University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>San Diego State University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Santa Clara University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Sarah Lawrence College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Savannah College of Art & Design</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>School of the Art Institute of Chicago</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>School of Visual Arts, New York</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Scripps - The Women's College, Claremont</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Smeal College of Business-Pennsylvania State University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Southern Methodist University, Dallas, Texas</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Stanford University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Stella Adler Los Angeles - Academy of Acting and Theatre</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Stony Brook University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Swarthmore College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Syracuse University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Teachers College, Columbia University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Temple University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>The Lee Strasberg, Theatre & Film Institute - New York</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>The New School</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>The School of Art Institute of Chicago</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>The University of Chicago</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Tufts University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of California, Berkeley</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of California, Davis | School of Law</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of California, Los Angeles</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of California, San Diego</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Hawaii</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Illinois Urbana-Champaign</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Massachusetts, Amherst</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Massachusetts, Boston</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Miami</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Michigan, Ann Arbor</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University Of North Dame</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Pennsylvania, USA</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Portsmouth</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Richmond</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Rochester</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of San Diego</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of San Francisco</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Southern California</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>                                            
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Texas, Austin</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Virginia</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>University of Wisconsin- Madison</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>                                            
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>USC Viterbi - School of Engineering</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Vanderbilt University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Vassar College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Virginia Tech</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Washington University in St Louis</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Wellesley College</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="coun-ava-card-sec" data-country="226">
                                                    <div class="coun-ava-card-inner">
                                                        <div class="coun-ava-icon">
                                                            <i class="fas fa-university"></i>
                                                        </div>
                                                        <h6>Wesleyan University</h6>
                                                        <small>United States</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- United States -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="college-counsell-btn-sec">
            <div class="containert">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="ieypy-programme-five-btn-sec text-center">
                            @if($college_counselling_banner && $college_counselling_banner->document && file_exists(public_path('uploads/academics/' . $college_counselling_banner->document)))
                                <a class="ieypy-programme-five-inner-btn"
                                href="{{ asset('uploads/academics/' . $college_counselling_banner->document) }}"
                                target="_blank">
                                Download School Brochure (PDF)
                                </a>
                            @else
                                <a class="ieypy-programme-five-inner-btn"
                                href="{{ $college_counselling_banner->url }}"
                                target="_blank">
                                Download School Brochure (PDF)
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>

    @include('components.frontend.footer')

    @include('components.frontend.main-js')


    <script>
        $(document).ready(function () {
            function filterSchools() {
                var selectedCountry = $("#country").val();

                if (selectedCountry === "") {
                    $(".coun-ava-card-sec").show(); 
                } else {
                    $(".coun-ava-card-sec").hide(); // Hide all
                    $('.coun-ava-card-sec[data-country="' + selectedCountry + '"]').show(); 
                }
            }

            // Run filter on change
            $("#country").on("change", filterSchools);

            // Run on page load (default)
            filterSchools();
        });
    </script>


</body>
</html>